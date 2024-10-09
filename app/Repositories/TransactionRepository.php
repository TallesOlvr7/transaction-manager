<?php

namespace App\Repositories;
use App\DTOs\TransactionDTO;
use App\Models\Transaction;
use App\Repositories\Intefaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function create(TransactionDTO $transactionDTO):Transaction
    {
        return Transaction::create([
            'payer'=>$transactionDTO->payerId,
            'payee'=>$transactionDTO->payeeId,
            'value'=>$transactionDTO->value,
        ]);
    }
}