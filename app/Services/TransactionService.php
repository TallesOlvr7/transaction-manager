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
    ) {
    }
    public function makeTransaction(string $payerId, array $request):Transaction
    {
        $this->transactionVerifications($payerId, $request['value']);
        $this->transferMoney($payerId, $request);
        return $this->transactionRepository->create($payerId,$request);
    }

    public function transferMoney(string $payerId, array $request): void
    {
        try {
            DB::beginTransaction();
            $debitSuccess = $this->walletService->debitUser($payerId, $request['value']);
            $creditSuccess = $this->walletService->creditUser($request['payee'], $request['value']);

            if ($debitSuccess && $creditSuccess) {
                DB::commit();
            }
            DB::rollback();
        }catch(\Exception $e){
            DB::rollback();
            throw new \Exception("Erro ao fazer transação.");
        }
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