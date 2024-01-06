<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Session;

class Auth
{
    public static function user()
    {
        $data = isset(Session::get('user')->data) ? Session::get('user')->data : null;
        return $data;
    }

    public static function auth($username, $password)
    {
        $post = [
            'username' => $username,
            'password' => $password,
        ];

        $apiKey = config('simkeu.simkeu_api_key');
        $url = config('simkeu.simkeu_url') . "auth";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "apikey: $apiKey",

        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);

        if ($response->status == true) {
            Session::put('user', $response);
        }

        return $response;
    }
}