<?php

namespace App\DTOs;

class TransactionDTO
{
    public readonly string $payerId;
    public readonly string $payeeId;
    public readonly float $value;

    public function __construct(
        string $payerId,
        string $payeeId,
        float $value
    )
    {
        $this->payerId = $payerId;
        $this->payeeId = $payeeId;
        $this->value = $value;
    }
}