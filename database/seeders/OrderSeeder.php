<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all users excluding the admin
        $users = User::where('email', '!=', 'admin@gmail.com')->get();

        // Generate 5 orders for year 2022
        foreach ($users as $index => $user) {
            // Distribute the orders throughout the year
            $date = "2022-" . rand(1, 12) . "-" . rand(1, 28);

            // Stop creating orders if there are already 25 or more
            if (Order::count() >= 25) {
                return;
            }

            $this->createOrderAndItems($user, $date);
        }

        // Generate 4 orders for each month of 2023 for each user
        foreach ($users as $user) {
            for ($month = 1; $month <= 6; $month++) {
                for ($i = 0; $i < 4; $i++) {
                    $date = "2023-" . $month . "-" . rand(1, 20);

                    // Stop creating orders if there are already 25 or more
                    if (Order::count() >= 30) {
                        return;
                    }

                    $this->createOrderAndItems($user, $date);
                }
            }
        }
    }

    private function createOrderAndItems($user, $date)
    {
        $order = Order::create([
            'user_id' => $user->id,
            'order_date' => $date,
            'status' => 'Pembayaran belum di konfirmasi', // or any status that you have
            'payment_confirmation_image' => 'dummy_image.jpg', // replace with actual image or url
        ]);

        // Generating 1 to 3 random order items for each order
        for ($j = 0; $j < rand(1, 3); $j++) {
            $order->orderItems()->create([
                'product_id' => rand(1, 20),
                'quantity' => rand(1, 3),
            ]);
        }
    }
}
