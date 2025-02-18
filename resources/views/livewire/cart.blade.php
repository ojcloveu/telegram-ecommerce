<div>
    <h2>Shopping Cart</h2>
    <ul>
        @foreach ($cartItems as $item)
            <li>{{ $item->product->name }} - ${{ $item->product->price }}</li>
        @endforeach
    </ul>
</div>