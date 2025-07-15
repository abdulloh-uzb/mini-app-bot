<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{

    public function __construct(protected Api $telegram, protected AuthService $authService) {}

    public function show()
    {
        $response = $this->telegram->getMe();

        return $response;
    }

    public function handle(Request $request)
    {
        $update = Telegram::getWebhookUpdate();
        $message = $update->getMessage();
        $chatId = $update->getMessage()->getChat()->getId();

        if ($message?->getText() === '/start') {
            Telegram::sendMessage([
                'chat_id' => $message->getChat()->getId(),
                'text' => 'Iltimos, kontakt raqamingizni yuboring:',
                'reply_markup' => json_encode([
                    'keyboard' => [
                        [
                            [
                                'text' => '📱 Kontakt ulashish',
                                'request_contact' => true
                            ]
                        ]
                    ],
                    'resize_keyboard' => true,
                    'one_time_keyboard' => true,
                ]),
            ]);
        }
        if ($message?->getContact()) {
            $phone = $message->getContact()->getPhoneNumber();
            $tgId = $message->getFrom()->getId();

            $loginSuccess = $this->authService->login($phone, $tgId);

            if ($loginSuccess === true) {
                Telegram::sendMessage([
                    'chat_id' => $message->getChat()->getId(),
                    'text' => '✅ Tizimga kirdingiz!',
                ]);

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => '🌐 Web ilovaga kirish uchun tugmani bosing:',
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [[
                                'text' => '🌐 Web ilova',
                                'web_app' => [
                                    'url' => 'https://18a4ba1bccd7.ngrok-free.app/home?tg_id=' . $tgId
                                ]
                            ]]
                        ]
                    ]),
                ]);
            } else {
                Telegram::sendMessage([
                    'chat_id' => $message->getChat()->getId(),
                    'text' => '❌ Login amalga oshmadi.',
                ]);
            }
        }


        return response('ok');
    }

}
