<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $request->input('product_id'),
        ]);

        return response()->json(['message' => 'Product added to cart', 'cart' => $cart]);
    }

    public function getCart()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        return response()->json($cartItems);
    }
}
