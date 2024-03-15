<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 150 productos asociados a la categoría normal
        Product::factory(150)->create()->each(function ($product) {
            $this->normal($product);
        });

        // Crear 150 productos asociados a la categoría delivery
        Product::factory(150)->create()->each(function ($product) {
            $this->delivery($product);
        });
    }

    private function normal($product)
    {
        // Lógica para asociar el producto a la categoría normal
        $categoriaNormal = Category::firstOrCreate(['name' => 'normal']);
        $product->categories()->attach($categoriaNormal);
        $categoriaNormal->products()->attach($product);
    }

    private function delivery($product)
    {
        // Lógica para asociar el producto a la categoría delivery
        $categoriaDelivery = Category::firstOrCreate(['name' => 'delivery']);
        $product->categories()->attach($categoriaDelivery);
        $categoriaDelivery->products()->attach($product);
    }
}
