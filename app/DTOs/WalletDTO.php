<?php

namespace App\DTOs;

class WalletDTO
{
    public readonly float $money;
    public readonly string $userId;

    public function __construct(
        float $money,
        string $userId,
    )
    {
        $this->money = $money;
        $this->userId = $userId;
    }
}