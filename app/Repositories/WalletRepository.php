<?php

namespace App\Repositories;
use App\Models\User;
use App\Models\Wallet;
use App\Repositories\Intefaces\WalletRepositoryInterface;

class WalletRepository implements WalletRepositoryInterface
{
    public function getMoneyByUserId(string $userId):float
    {
        return User::find($userId)->wallet->money;
    }

    public function decrement(string $userId, float $value):bool
    {
        if(Wallet::where('user_id', $userId)->decrement('money', $value)){
            return true;
        }
        return false;
    }

    public function increment(string $userId, float $value):bool
    {
        if(Wallet::where('user_id', $userId)->increment('money', $value)){
            return true;
        }
        return false;
    }
}