<?php

namespace App\Repositories\Intefaces;

interface WalletRepositoryInterface
{
    public function getMoneyByUserId(string $userId):float;
    public function decrement(string $userId, float $value):bool;
    public function increment(string $userId, float $value):bool;
}