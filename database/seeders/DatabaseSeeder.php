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
        FabricType::factory()
            ->count(4)
            ->has(
                FabricVariant::factory()
                    ->count(3)
                    ->has(
                        Product::factory()
                            ->count(10)
                    )
            )
            ->create();
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
