<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    protected static ?string $password;

    public function definition(): array
    {
        $types = collect(['Customer','Retailer']);
        return [
            'complete_name' => fake()->name(),
            'document_id'=>fake()->unique()->regexify('[0-9]{2}\.[0-9]{3}\.[0-9]{3}-[0-9]'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'type'=>$types->random(),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
