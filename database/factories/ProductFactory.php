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
    public function definition(): array {
        return [
            'id' => Str::uuid(),
            'name' => $this->faker->word(),
            'sku' => strtoupper($this->faker->bothify('SKU-####')),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'in_stock' => $this->faker->boolean(90),
            'min_qty' => $this->faker->numberBetween(1, 10),
            'weight' => $this->faker->randomFloat(3, 0.1, 10),
            'volume' => $this->faker->randomFloat(3, 0.1, 5),
        ];
    }
}
