<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Telegram\Bot\Laravel\Facades\Telegram;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Order extends Model
{
    use CrudTrait;

    protected $fillable = ['user_id', 'total', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::created(function ($order) {
            Telegram::sendMessage([
                'chat_id' => $order->user->telegram_id,
                'text' => "Your order #{$order->id} has been placed successfully!"
            ]);
        });
    }
}
