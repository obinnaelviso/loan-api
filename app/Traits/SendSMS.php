<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;

trait SendSMS {

    public function sendSMS($phone, $message) {
        $phone = formatPhoneNumber($phone);
        // try {
            $response = Http::get(config('kudisms.url'), [
                'username' => config('kudisms.username'),
                'password' => config('kudisms.password'),
                'sender' => config('app.name'),
                'mobiles' => $phone,
                'message' => $message,
            ]);
            if ($response->successful()) {
                // return data from verification
                $errCode = $response->object()->errno;
                $error = $response->object()->error;
                if ($errCode == "000") {
                    return true;
                } else {
                    // return report($error);
                    return $error;
                }
            } else {
                return false;
            }
        // } catch(\Throwable $e) {
        //    // report error
        //     return false;
        // }
    }
}
