<?php

namespace App\Repositories\Intefaces;
use App\DTOs\TransactionDTO;
use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function create(TransactionDTO $transactionDTO):Transaction;
}