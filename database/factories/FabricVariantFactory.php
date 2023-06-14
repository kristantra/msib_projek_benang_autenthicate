<?php

namespace Database\Factories;

use App\Models\FabricType;
use App\Models\FabricVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class FabricVariantFactory extends Factory
{
    protected $model = FabricVariant::class;

    public function definition()
    {
        return [
            'fabric_type_id' => FabricType::factory(),
            'name' => $this->faker->word,
        ];
    }
}
