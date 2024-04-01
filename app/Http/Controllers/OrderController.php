<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function placeOrder(Request $request)
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
        }
        
        // Retrieve the cart items
        $cartItems = $request->session()->get('cart', []);

        // Calculate the total price
        $total = 0;
        foreach ($cartItems as $productId => $quantity) {
            $product = Product::findOrFail($productId);
            $total += $product->selling_price * $quantity;
        }

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
        ]);

        // Associate products with the order
        foreach ($cartItems as $productId => $quantity) {
            $product = Product::findOrFail($productId);
            $order->products()->attach($product, ['quantity' => $quantity]);
        }

        // Clear the cart
        $request->session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }

    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
            $end_date = Carbon::parse($request->input('end_date'))->endOfDay();

            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $orders = $query->paginate(2);

        return view('orders.index', compact('orders'));
    }
    
}
