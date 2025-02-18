<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TelegramAuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::updateOrCreate(
            ['telegram_id' => $request->input('id')],
            [
                'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
                'phone' => $request->input('phone_number'),
            ]
        );

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }
}
