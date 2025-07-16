<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected AuthService $authService) {}
    
    public function handler($update)
    {
        $message = $update->getMessage();

        if ($message?->getText() === '/start') {
            $this->startCommand($message);
        }

        if ($message?->getContact()) {
            $this->contactCommand($message);
        }
    }

    private function startCommand($message)
    {
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

    private function contactCommand($message)
    {
        $phone = $message->getContact()->getPhoneNumber();
        $tgId = $message->getFrom()->getId();

        $loginSuccess = $this->authService->login($phone, $tgId);
        Log::info('Login attempt', ['phone' => $phone, 'tg_id' => $tgId, 'success' => $loginSuccess]);
        if ($loginSuccess === true) {
            Telegram::sendMessage([
                'chat_id' => $message->getChat()->getId(),
                'text' => '✅ Tizimga kirdingiz!',
            ]);

            Telegram::sendMessage([
                'chat_id' => $message->getChat()->getId(),
                'text' => '🌐 Web ilovaga kirish uchun tugmani bosing:',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [[
                            'text' => '🌐 Web ilova',
                            'web_app' => [
                                'url' => 'https://de4fca37849a.ngrok-free.app/home?tg_id=' . $tgId
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

}
