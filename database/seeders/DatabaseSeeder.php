<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Apple',
            'email' => 'apple@abalit.org',
            'password' => bcrypt('1234'),
            'address' => "Carrer d'Aragó, 141, 5è 3a, 08015 Barcelona",
            'type' => 1,
            'phone' => fake()->phoneNumber()
        ]);

        
        \App\Models\User::factory(99)->create();

        \App\Models\Category::factory()->create([
           'name'=> 'normal'
       ]);

       \App\Models\Category::factory()->create([
           'name'=> 'delivery'
       ]);

       // Llamar al seeder de productos
       $this->call([
           ProductSeeder::class,
       ]);
    }
}
