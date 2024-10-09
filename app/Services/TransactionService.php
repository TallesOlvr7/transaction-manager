<?php

namespace App\Services;
use App\DTOs\TransactionDTO;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use DB;
use Http;

class TransactionService
{
    public function __construct(
        protected WalletService $walletService,
        protected TransactionRepository $transactionRepository,
    ) 
    {}

    public function makeTransaction(TransactionDTO $transactionDTO):Transaction
    {
        $this->transactionVerifications($transactionDTO->payerId, $transactionDTO->value);
        if(!$this->transferMoney($transactionDTO)){
            throw new \Exception("Erro ao fazer transação.");
        }
        return $this->transactionRepository->create($transactionDTO);
    }

    public function transferMoney(TransactionDTO $transactionDTO):bool
    {
            DB::beginTransaction();

            $debitSuccess = $this->walletService->debitUser($transactionDTO->payerId, $transactionDTO->value);

            $creditSuccess = $this->walletService->creditUser($transactionDTO->payeeId, $transactionDTO->value);

            if ($debitSuccess && $creditSuccess) {
                DB::commit();
                return true;
            }

            DB::rollback();
            return false;
    }        

    public function transactionVerifications(string $payerId, float $value): void
    {
        $getStatus = Http::get('https://util.devi.tools/api/v2/authorize')->json('status');
        if ($getStatus === 'fail') {
            throw new \Exception("Transação não autorizada.");
        }

        if ($this->walletService->getMoney($payerId) < $value) {
            throw new \Exception("Saldo insuficiente.");
        }
    }
}