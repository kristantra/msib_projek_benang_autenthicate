<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creating 5 new users with specific emails
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => 'test' . $i,
                'email' => 'test' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'phone_number' => '081' . rand(100000000, 999999999),
                'alamat' => Str::random(10),
            ]);

            // Assign the role 'user' to the newly created user
            $user->assignRole('user');
        }
    }
}
