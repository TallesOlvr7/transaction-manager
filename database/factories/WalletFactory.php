<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{

    public function definition(): array
    {
        return [
            'amount'=>100.00,
            'user_id'=>'9d1f8f64-8366-47b9-acda-31f7f82de29c'
        ];
    }
}
