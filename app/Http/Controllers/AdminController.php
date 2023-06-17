<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



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

    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            // Delete related OrderItems
            $order->orderItems()->delete();
            // Delete Payment confirmation image if it exists
            if ($order->payment_confirmation_image) {
                $image_path = public_path() . '/images/' . $order->payment_confirmation_image;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            // Delete the order
            $order->delete();
        }
        return redirect()->route('admin.paymentindex')->with('status', 'Order deleted successfully!');
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
    public function createManualOrder()
    {
        $users = User::all(); // retrieve all users for the dropdown
        $products = Product::all(); // retrieve all products for the dropdown
        return view('admin.manualorder', compact('users', 'products'));
    }

    public function storeManualOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'order_date' => 'required',
            'paymentProofUpload' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Add this line
        ]);

        // Check if the product has enough stock to fulfill the order
        $product = Product::findOrFail($request->product_id);
        if ($product->quantity < $request->quantity) {
            return back()->withErrors(['Not enough product quantity available.']);
        }

        // Process the image and save it in the 'images' directory, if image is uploaded
        $imageName = null;
        if ($request->hasFile('paymentProofUpload')) {
            $imageName = time() . '.' . $request->paymentProofUpload->extension();
            $request->paymentProofUpload->move(public_path('images'), $imageName);
        }

        // Create order
        $order = Order::create([
            'user_id' => $request->user_id,
            'order_date' => $request->order_date,
            'status' => 'Pembayaran melalui tokopedia',
            'payment_confirmation_image' => $imageName,
        ]);

        // Create order item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        // Update product quantity
        $product->quantity -= $request->quantity;
        $product->save();

        return redirect()->route('admin.manualorder')->with('status', 'Manual order has been created successfully!');
    }
}
