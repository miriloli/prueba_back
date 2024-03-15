<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake() -> text(20), /*, lo he cambiado lo de despues no sirve !!!esto genera una unica palabra tiene un parametro opcional int que es el numero de palabras x defecto 1*/
            'description' => fake() -> paragraph(), /*genera un parrafo aleatorio*/
            'price' => fake() -> randomFloat(2, 1, 300), /*esto un float con dos decimales entre 1 y 300*/ 
            'image' => fake() -> imageUrl(640, 480, 'random', true), /*ESTO ME LO PREGUNTAS pero es una url que representa una imagen falsa*/

        ];
    }
}
