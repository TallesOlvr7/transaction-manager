<?php

namespace App\Services;
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

    public function makeTransaction(string $payerId, array $request):Transaction
    {
        $this->transactionVerifications($payerId, $request['value']);
        if(!$this->transferMoney($payerId, $request)){
            throw new \Exception("Erro ao fazer transação.");
        }
        return $this->transactionRepository->create($payerId,$request);
    }

    public function transferMoney(string $payerId, array $request):bool
    {
            DB::beginTransaction();
            $debitSuccess = $this->walletService->debitUser($payerId, $request['value']);
            $creditSuccess = $this->walletService->creditUser($request['payee'], $request['value']);

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
            throw new \Exception("Saldo insuficiente");
        }
    }
}