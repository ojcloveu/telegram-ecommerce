<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;
use App\Models\User;

class TelegramController extends Controller
{
    protected $telegram;

    public function __construct()
    {
        $this->telegram = new Api(config('services.telegram.bot_token'));
    }

    // Handle incoming webhook
    public function handleWebhook(Request $request)
    {
        $update = $request->all();

        if (isset($update['message'])) {
            $message = $update['message'];
            $chatId = $message['chat']['id'];
            $text = $message['text'] ?? '';

            if ($text === '/start') {
                $this->sendWelcomeMessage($chatId);
            }
        }

        return response()->json(['status' => 'ok']);
    }

    // Send welcome message
    private function sendWelcomeMessage($chatId)
    {
        $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "Welcome to our eCommerce Mini App! Click below to start shopping.",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => '🛒 Open Shop', 'web_app' => ['url' => config('services.telegram.webapp_url')]]]
                ]
            ])
        ]);
    }
}
