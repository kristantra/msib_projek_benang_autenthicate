<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function confirmPaymentIndex()
    {
        $orders = Order::all(); // retrieve all orders
        return view('admin.paymentindex', compact('orders'));
    }

    public function confirmPayment($id)
    {
        $order = Order::findOrFail($id);

        // Toggle the status between 'pending' and 'accepted'
        $order->status = $order->status === 'pending' ? 'accepted' : 'pending';

        $order->save();

        return redirect()->route('admin.paymentindex')->with('status', 'Payment status updated!');
    }
}
