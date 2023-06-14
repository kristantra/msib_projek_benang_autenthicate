<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function confirmPaymentIndex()
    {
        $orders = Order::all(); // retrieve all orders
        return view('admin.paymentindex', compact('orders'));
    }

    public function confirmPayment(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Update the status to the one selected in the dropdown
        $order->status = $request->status;

        $order->save();

        return redirect()->route('admin.paymentindex')->with('status', 'Payment status updated!');
    }

    public function salesReport()
    {
        $orders = Order::all();

        $productSales = [];
        $totalRevenue = [
            'daily' => 0,
            'weekly' => 0,
            'monthly' => 0,
            'yearly' => 0,
        ];
        $unsoldProducts = Product::all()->pluck('id')->toArray();

        $now = Carbon::now();

        foreach ($orders as $order) {
            $orderDate = Carbon::parse($order->order_date);
            foreach ($order->orderItems as $item) {
                $itemTotal = $item->quantity * $item->product->price;
                if (isset($productSales[$item->product_id])) {
                    $productSales[$item->product_id]['quantity'] += $item->quantity;
                    $productSales[$item->product_id]['total_sales'] += $itemTotal;
                } else {
                    $productSales[$item->product_id] = [
                        'name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'total_sales' => $itemTotal,
                    ];
                }

                if ($orderDate->isToday()) {
                    $totalRevenue['daily'] += $itemTotal;
                }

                if ($orderDate->greaterThanOrEqualTo($now->copy()->startOfWeek())) {
                    $totalRevenue['weekly'] += $itemTotal;
                }

                if ($orderDate->greaterThanOrEqualTo($now->copy()->startOfMonth())) {
                    $totalRevenue['monthly'] += $itemTotal;
                }

                if ($orderDate->greaterThanOrEqualTo($now->copy()->startOfYear())) {
                    $totalRevenue['yearly'] += $itemTotal;
                }

                if (($key = array_search($item->product_id, $unsoldProducts)) !== false) {
                    unset($unsoldProducts[$key]);
                }
            }
        }

        // Sort by quantity, descending
        uasort($productSales, function ($a, $b) {
            return $b['quantity'] <=> $a['quantity'];
        });

        $unsoldProducts = Product::whereIn('id', $unsoldProducts)->get();

        return view('admin.sales-report', compact('productSales', 'totalRevenue', 'unsoldProducts'));
    }
}
