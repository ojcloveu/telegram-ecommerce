<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Telegram\Bot\Laravel\Facades\Telegram;

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

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|numeric',
            'first_name' => 'required|string',
            'last_name' => 'nullable|string',
            'username' => 'nullable|string',
            'photo_url' => 'nullable|string',
            'auth_date' => 'required|numeric',
            'hash' => 'required|string',
        ]);

        // Validate Telegram signature (security measure)
        if (!$this->isValidTelegramAuth($data)) {
            return response()->json(['error' => 'Invalid authentication'], 403);
        }

        // Register or update user
        $user = User::updateOrCreate(
            ['telegram_id' => $data['id']],
            [
                'name' => $data['first_name'] . ' ' . ($data['last_name'] ?? ''),
                'username' => $data['username'] ?? null,
                'profile_photo' => $data['photo_url'] ?? null,
            ]
        );

        // Generate API token
        $token = $user->createToken('telegram-auth')->plainTextToken;

        return response()->json([
            'message' => 'User authenticated successfully',
            'user' => $user,
            'token' => $token,
        ]);
    }

    private function isValidTelegramAuth($data)
    {
        // Your validation logic (using bot secret key)
        return true; // Placeholder, implement proper security check
    }
}
