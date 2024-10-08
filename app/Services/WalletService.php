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

    public function debitUser(string $id, float $value):bool
    {
        return $this->walletRepository->decrement($id, $value);
    }

    public function creditUser(string $id, float $value):bool
    {
        return $this->walletRepository->increment($id, $value);
    }
}
