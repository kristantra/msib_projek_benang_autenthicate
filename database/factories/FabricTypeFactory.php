<?php

namespace Database\Factories;

use App\Models\FabricType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FabricTypeFactory extends Factory
{
    protected $model = FabricType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
