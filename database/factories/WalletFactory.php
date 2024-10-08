<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    private static $usedUsers = [];
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();

        while (in_array($user->id, self::$usedUsers)) {
            $user = User::inRandomOrder()->first();
        }

        self::$usedUsers[] = $user->id;
        return [
            'money' => 100.00,
            'user_id' => $user->id
        ];
    }
}
