<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    protected static ?string $isAdmin;
    protected static ?string $name;
    protected static ?string $email;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => static::$name ?? $this->faker->name(),
            'email'             => static::$email ?? $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ?? Hash::make('12345678'),
            'is_admin'          => static::$isAdmin  ?? 0,
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Set the password for the user.
     *
     * @param  string  $password
     * @return $this
     */
    public function password(string $password): static
    {
        static::$password = Hash::make($password);

        return $this->state([
            'password' => static::$password,
        ]);
    }

    /**
     * Set the name for the user.
     *
     * @param  string  $name
     * @return $this
     */
    public function name(string $name): static
    {
        static::$name = $name;
        return $this->state([
            'name' => static::$name,
        ]);
    }

    /**
     * Set the email for the user.
     *
     * @param  string  $email
     * @return $this
     */
    public function email(string $email): static
    {
        static::$email = $email;
        return $this->state([
            'email' => static::$email,
        ]);
    }

    /**
     * Set the is_admin flag for the user.
     *
     * @param  int  $isAdmin
     * @return $this
     */
    public function isAdmin(int $isAdmin): static
    {
        static::$isAdmin = $isAdmin;

        return $this->state([
            'is_admin' => static::$isAdmin,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
