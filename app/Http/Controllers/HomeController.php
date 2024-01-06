<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        if ($data) {

            return redirect()->route('admin.dashboard');
        }
        // if ($data->level_id == 1) {
        // }
        // dd($data);
        return view('home');
    }

    public function root()
    {
        $data = Auth::user();
        // dd($data);
        // $data = User::find(1);
        // Auth::login($data);
        return redirect()->route('login');
    }

    public function logged()
    {
        $data = Auth::user();
        dd($data);
    }

    public function testes()
    {
        $a = Kategori::all();
        dd($a);
        // $file = "20230614091129-(2) kwitansi-auto-isi-terbilang.xlsx";
        // dd(GoogleDrive::link($file));
        // Auth::auth('muhammadadil', '123456');
        // $data = Auth::user();
        // dd($data);
    }
}