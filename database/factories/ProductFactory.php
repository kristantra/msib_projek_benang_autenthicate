<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\FabricVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'fabric_variant_id' => FabricVariant::factory(),
            'color' => $this->faker->safeColorName,
            'color_code' => $this->faker->hexColor,
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
