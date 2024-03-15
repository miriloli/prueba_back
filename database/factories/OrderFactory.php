<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Order;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pickup_date' => fake()->date('Y-m-d'),
            'pickup_time' => fake()->time('H:i:s'),
            'payment_method'=> 'card',
            'user_id' => 1,
        ];
    }

    public function configure(){
        return $this->afterCreating(function (Order $order) {
            
            // Obtener uno o varios productos aleatoriamente
            $products = Product::inRandomOrder()->limit(rand(1, 3))->get();
            
            // Asociar los productos al pedido
            $order->products()->attach($products);

            // Asociar el pedido al/los producto(s)
            foreach ($products as $product) {
                $product->orders()->attach($order);
            }
        });
    }
}
