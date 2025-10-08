<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker ?? \Faker\Factory::create();
        $name = $faker->name();
        $parts = explode(' ', $name, 3);
        $first = $parts[0] ?? null;
        $last = $parts[count($parts) - 1] ?? null;

        return [
            'first_name' => $first,
            'middle_name' => count($parts) === 3 ? $parts[1] : null,
            'last_name' => $last,
            'role' => 'client',
            'email' => $faker->unique()->safeEmail(),
            'email_verified_at' => \now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
