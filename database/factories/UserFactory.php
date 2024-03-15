<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Order;

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
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->unique()->address(),
            'password' => static::$password ??= Hash::make('password'),
            'type' => 1,
            'remember_token' => Str::random(10),
        ];
    }

    
    public function configure(){
        return $this->afterCreating(function (User $user) {
            // Crea 3 pedidos para cada usuario
            Order::factory()->create([
                'pickup_date' => fake()->date('Y-m-d'),
                'pickup_time' => fake()->time('H:i:s'),
                'payment_method'=> 'card',
                'user_id' => $user->id,
            ]);

            Order::factory()->create([
                'pickup_date' => fake()->date('Y-m-d'),
                'pickup_time' => fake()->time('H:i:s'),
                'payment_method'=> 'card',
                'user_id' => $user->id,
            ]);

            // Crear una orden "cash" para cada usuario
            Order::factory()->create([
                'pickup_date' => fake()->date('Y-m-d'),
                'pickup_time' => fake()->time('H:i:s'),
                'payment_method'=> 'cash',
                'user_id' => $user->id,
            ]);
        });
    }
}
