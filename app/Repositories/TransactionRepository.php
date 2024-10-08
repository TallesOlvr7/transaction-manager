<?php

namespace App\Repositories;
use App\Models\Transaction;
use App\Repositories\Intefaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function create(string $userId, array $request):Transaction
    {
        return Transaction::create([
            'payer'=>$userId,
            'payee'=>$request['payee'],
            'value'=>$request['value'],
        ]);
    }
}