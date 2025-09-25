<?php

// php artisan make:factory ItemFactory

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    //Modify
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'category_id' => $this->faker->numberBetween(1, 2),
            'price' => $this->faker->randomFloat(2, 1000, 100000),
            'description' => $this->faker->text(),
            'img' => fake()->randomElement([
                'https://images.unsplash.com/photo-1591814468924-caf88d1232e1', 
                'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351', 
                'https://images.unsplash.com/photo-1680674814945-7945d913319c',
                ]),
            'is_active' => $this->faker->boolean(),
        ];
        //----------------
    }
}
