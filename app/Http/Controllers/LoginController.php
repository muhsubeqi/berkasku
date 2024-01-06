<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $dataValidated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $response = Auth::attempt(['username' => $dataValidated['username'], 'password' => $dataValidated['password']]);

        if ($response == true) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('failed', 'Login gagal');
        }

    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }
}