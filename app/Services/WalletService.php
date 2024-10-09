<?php

namespace App\Services;
use App\Repositories\WalletRepository;

class WalletService
{
    public function __construct(
        protected WalletRepository $walletRepository,
    )
    {}

    public function getMoney(string $id):float
    {
        return $this->walletRepository->getMoneyByUserId($id);
    }

    public function debitUser(string $payerId, float $value):bool
    {
        return $this->walletRepository->decrement($payerId, $value);
    }

    public function creditUser(string $payeeId, float $value):bool
    {
        return $this->walletRepository->increment($payeeId , $value);
    }
}