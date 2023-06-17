<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
        $admin->assignRole('admin');

        // Tokopedia User
        User::create([
            'name' => 'tokopedia',
            'email' => 'tokopedia@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Replace with the actual password
        ]);

        // Offline Buyer User
        User::create([
            'name' => 'offlineBuyer',
            'email' => 'offlineBuyer@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Replace with the actual password
        ]);
    }
}
