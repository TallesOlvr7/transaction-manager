<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{

    public function run(): void
    {
        Wallet::factory(3)->create();
    }
}
