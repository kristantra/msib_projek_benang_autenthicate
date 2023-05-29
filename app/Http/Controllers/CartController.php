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

        // validation for product_id and quantity, 
        // and you could also add some checks if the product is available or not

        $cart = session()->get('cart', []);

        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            $product = Product::with(['fabricVariant', 'fabricVariant.fabricType'])->find($product_id);
            $cart[$product_id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image,
                'fabric_variant' => $product->fabricVariant->name,
                'fabric_type' => $product->fabricVariant->fabricType->name
            ];
        }

        session()->put('cart', $cart);
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

    public function checkout()
    {
        // Here you could pass any additional data to the view if needed
        return view('checkout.index');
    }

    public function confirmCheckout(Request $request)
    {
        // Here you would handle the confirmation of the order
        // Save the order to the database
        // Clear the cart from the session

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->order_date = now();
        $order->status = 'pending';
        $order->save();

        foreach (session('cart') as $id => $details) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $id;
            $orderItem->quantity = $details['quantity'];
            $orderItem->save();
        }

        $request->session()->forget('cart');

        return redirect()->route('checkout')->with('success', 'Order confirmed!');
    }
}
