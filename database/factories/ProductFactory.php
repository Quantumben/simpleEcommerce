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
    public function definition()
    {
        return [

                    'name' => fake()->sentence(3),
                    'image' => 'uploads/products/book.png',
                    'description' => fake()->paragraph(4),
                    'price' => fake()->numberBetween(100, 10000)
        ];
    }
}
