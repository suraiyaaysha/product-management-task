<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest()->paginate(12);

        $cart = $request->session()->get('cart', []);
        $cartItems = Product::whereIn('id', array_keys($cart))->get();

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cartItems as $cartItem) {
            $subtotal += $cart[$cartItem->id] * $cartItem->selling_price;
        }

        // Dummy discount for testing purposes
        $discount = 5;

        // Calculate tax (testing tax rate is 10%)
        $taxRate = 0.1;
        $tax = $subtotal * $taxRate;

        // Calculate total
        $total = $subtotal - $discount + $tax;

        return view('pos.index', compact('cartItems', 'cart', 'products', 'subtotal', 'discount', 'tax', 'total'));
    }

    public function cartItemList(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $cartItems = Product::whereIn('id', array_keys($cart))->get();
        $products = Product::latest()->paginate(12);

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cartItems as $cartItem) {
            $subtotal += $cart[$cartItem->id] * $cartItem->selling_price;
        }

        // Dummy discount for testing purposes
        $discount = 5;

        // Calculate tax (testing tax rate is 10%)
        $taxRate = 0.1;
        $tax = $subtotal * $taxRate;

        // Calculate total
        $total = $subtotal - $discount + $tax;

        return view('pos.index', compact('cartItems', 'cart', 'products', 'subtotal', 'discount', 'tax', 'total'));
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = $request->session()->get('cart', []);
        $cart[$productId] = isset($cart[$productId]) ? $cart[$productId] + 1 : 1;
        $request->session()->put('cart', $cart);

        return redirect()->route('pos.cartItemList')->with('success', 'Product added to cart successfully.');
    }

    public function updateCartItem(Request $request, $productId)
    {
        $cart = $request->session()->get('cart', []);
        $quantity = $request->input('quantity');

        if (isset($cart[$productId])) {
            $cart[$productId] = $quantity;
            $request->session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    public function deleteCartItem(Request $request, $productId)
    {
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('pos.cartItemList')->with('success', 'Product removed from cart successfully.');
    }

    public function filter(Request $request)
    {

        $cart = $request->session()->get('cart', []);
        $cartItems = Product::whereIn('id', array_keys($cart))->get();

        // Calculate subtotal
        $subtotal = 0;
        foreach ($cartItems as $cartItem) {
            $subtotal += $cart[$cartItem->id] * $cartItem->selling_price;
        }

        // Dummy discount for testing purposes
        $discount = 5;

        // Calculate tax (testing tax rate is 10%)
        $taxRate = 0.1;
        $tax = $subtotal * $taxRate;

        // Calculate total
        $total = $subtotal - $discount + $tax;


        $searchQuery = $request->input('search');

        // Perform search query
        $products = Product::where('name', 'like', '%' . $searchQuery . '%')
        ->orWhere('sku', 'like', '%' . $searchQuery . '%')
        ->paginate(12);

        return view('pos.index', compact('products', 'searchQuery', 'cartItems', 'cart', 'subtotal', 'discount', 'tax', 'total'));
    }
}
