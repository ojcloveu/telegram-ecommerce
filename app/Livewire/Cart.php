<?php

namespace App\Livewire;

use App\Models\Cart;
use Livewire\Component;

class Cart extends Component
{
    public function addToCart($productId)
    {
        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
        ]);

        session()->flash('message', 'Product added to cart.');
    }

    public function render()
    {
        return view('livewire.cart', [
            'cartItems' => Cart::where('user_id', auth()->id())->get(),
        ]);
    }

}
