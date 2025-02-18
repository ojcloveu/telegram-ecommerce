<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram\Bot\Laravel\Facades\Telegram;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cart()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Your cart is empty'], 400);
        }

        // Create Order
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cartItems->sum(fn($item) => $item->product->price),
            'status' => 'pending',
        ]);

        // Clear cart
        $user->cart()->delete();

        // Send Telegram Notification
        Telegram::sendMessage([
            'chat_id' => $user->telegram_id,
            'text' => "Your order #{$order->id} has been placed successfully! Total: $" . $order->total
        ]);

        return response()->json(['message' => 'Order placed successfully', 'order' => $order]);
    }

    public function trackOrder($orderId)
    {
        $user = auth()->user();
        $order = Order::where('id', $orderId)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json([
            'order_id' => $order->id,
            'status' => $order->status,
            'total' => $order->total,
            'created_at' => $order->created_at,
        ]);
    }
}
