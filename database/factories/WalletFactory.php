<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{

    public function definition(): array
    {
        return [
            'amount'=>100.00,
            'user_id'=>'9d204a19-53e0-44b4-b528-2a6ec7e98601'
        ];
    }
}
