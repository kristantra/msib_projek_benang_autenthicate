<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {
        // Get cart data from session
        $cart = session()->get('cart');

        // Calculate total price of items in the cart
        $totalPrice = 0;
        if ($cart) {
            foreach ($cart as $item) {
                $totalPrice += $item['quantity'] * $item['price'];
            }
        }

        // Pass the cart data and total price to the view
        return view('cart.index', ['user' => Auth::user(), 'cart' => $cart, 'totalPrice' => $totalPrice]);
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Fetch the product details
        $product = Product::with(['fabricVariant', 'fabricVariant.fabricType'])->find($product_id);

        // Get the current cart data from session
        $cart = session()->get('cart', []);

        // Calculate total quantity for the product
        $totalQuantity = (isset($cart[$product_id]) ? $cart[$product_id]['quantity'] : 0) + $quantity;

        // Check if total quantity is not more than available quantity
        if ($totalQuantity > $product->quantity) {
            return back()->with('error', 'The total quantity for this product in the cart is more than available stock!');
        }

        // If product exists in cart, increment quantity
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            // Otherwise, add new product to cart
            $cart[$product_id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image,
                'fabric_variant' => $product->fabricVariant->name,
                'fabric_type' => $product->fabricVariant->fabricType->name
            ];
        }

        // Save the cart data back to the session
        session()->put('cart', $cart);

        // Redirect back with a success message
        return back()->with('success', 'Product added to cart successfully!');
    }



    public function updateCart(Request $request, $id)
    {
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }


    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Product removed from cart successfully!');
    }
    public function editCart($id)
    {
        $product = Product::find($id);

        return view('cart.update', ['product' => $product]);
    }
    // dari sini ke bawah itu untuk checkout
    public function checkout()
    {
        // Here you could pass any additional data to the view if needed
        return view('checkout.index');
    }

    public function confirmCheckout(Request $request)
    {
        // Check if the cart is empty


        // Check if the user has necessary information filled in
        $user = auth()->user();
        if (!$user->phone_number || !$user->alamat) {
            return back()->withErrors('Alamat atau nomor teleponmu belum lengkap');
        }

        // Validate the uploaded image
        $request->validate([
            'paymentProofUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'paymentProofUpload.required' => 'Bukti pembayaranmu gagal terupload'
        ]);

        // Process the image and save it in the 'images' directory
        $imageName = time() . '.' . $request->paymentProofUpload->extension();
        $request->paymentProofUpload->move(public_path('images'), $imageName);

        // Create a new Order and associate it with the current user
        $order = new Order();
        $order->user_id = $user->id;
        $order->order_date = now();
        $order->status = 'pending';
        $order->payment_confirmation_image = $imageName;
        $order->save();


        // Create OrderItems and associate them with the new Order
        foreach (session('cart') as $id => $details) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $id;
            $orderItem->quantity = $details['quantity'];
            $orderItem->save();

            // Reduce the quantity of the product in stock
            $product = Product::find($id);
            $product->quantity -= $details['quantity'];
            $product->save();
        }

        // Clear the cart
        $request->session()->forget('cart');

        // Redirect back to the checkout page with a success message
        if (session('cart') === null || count(session('cart')) == 0) {
            return redirect()->route('products.index')->with('success',  'Your order has been confirmed! You can now check your order status in the "My Orders" section.');
        }
        return redirect()->route('checkout')->with('success', 'Your order has been confirmed! You can now check your order status in the "My Orders" section.');
    }



    // public function uploadPaymentProof(Request $request)
    // {
    //     $request->validate([
    //         'paymentProofUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $imageName = time() . '.' . $request->paymentProofUpload->extension();

    //     $request->paymentProofUpload->move(public_path('images'), $imageName);

    //     $order = Order::find($request->session()->get('orderId'));

    //     if ($order) {
    //         $order->payment_confirmation_image = $imageName;
    //         $order->save();
    //     }

    //     $request->session()->forget('cart');
    //     $request->session()->forget('orderId');

    //     return back()
    //         ->with('success', 'You have successfully upload payment proof.')
    //         ->with('image', $imageName);
    // }
}
