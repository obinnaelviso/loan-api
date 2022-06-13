<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;

trait SendSMS {

    public function sendSMS($phone, $message) {
        $phone = formatPhoneNumber($phone);
        $response = Http::get(config('kudisms.url'), [
            'username' => config('kudisms.username'),
            'password' => config('kudisms.password'),
            'sender' => config('app.name'),
            'mobiles' => $phone,
            'message' => $message,
        ]);
        $data = array_merge([
            'error' => null,
            'errno' => null,
            'status' => null,
            'count' => null,
            'price' => null,
        ], $response->json());
        if ($response->successful()) {
            if ($data['error'] == null) {
                return true;
            } else {
                throw new \Exception((string)$data['error']);
            }
        } else {
            return false;
        }
    }
}
