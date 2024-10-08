<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'payer'=>$this->payer,
            'payee'=>$this->payee,
            'value'=>$this->value
        ];
    }
}
