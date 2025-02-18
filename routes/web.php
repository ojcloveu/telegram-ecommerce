<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/set-webhook', function () {
    $telegram = new \Telegram\Bot\Api(config('services.telegram.bot_token'));
    $response = $telegram->setWebhook(['url' => config('services.telegram.webapp_url') . '/api/telegram/webhook']);
    return $response;
});

