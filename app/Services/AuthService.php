<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class AuthService 
{
    public function login(int $phoneNumber, $tgId)
    {

        $user = User::where("phone_number", $phoneNumber)->get()->first();

        if(!$user){
            return false;
        }

        if(!$user->hasRole('teacher')) {
            return false;
        }
        Log::info('User found', ['user_id' => $user->id, 'name' => $user->name, 'tg_id' => $tgId]);
        $user->update([
            "tg_id" => $tgId
        ]);

        return true;
        
    }
}

