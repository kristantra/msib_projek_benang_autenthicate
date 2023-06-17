<?php

namespace Database\Seeders;

use App\Models\FabricType;
use App\Models\FabricVariant;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $fabricTypes = [
            'katun' => ['small ply', 'big ply', 'soft cotton big'],
            'rayon' => ['rayon polos', 'rayon sembur'],
            'polyester' => ['soft polyester (small ply)', 'soft polyester (big ply)'],
        ];

        foreach ($fabricTypes as $type => $variants) {
            $fabricType = FabricType::create(['name' => $type]);

            foreach ($variants as $variant) {
                $fabricVariant = FabricVariant::create([
                    'name' => $variant,
                    'fabric_type_id' => $fabricType->id,
                ]);

                // Modify as needed
                Product::factory()->count(4)->create([
                    'fabric_variant_id' => $fabricVariant->id,
                ]);
            }
        }

        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
