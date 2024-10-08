<?php

namespace App\Repositories\Intefaces;
use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function create(string $payerId, array $request):Transaction;
}