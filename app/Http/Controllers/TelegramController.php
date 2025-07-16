<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuthService;
use App\Services\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{

    public function __construct(private TelegramService $telegramService) {}

    public function handle()
    {
        $update = Telegram::getWebhookUpdate();

        $this->telegramService->handler($update);

        return response('ok');
    }

}
