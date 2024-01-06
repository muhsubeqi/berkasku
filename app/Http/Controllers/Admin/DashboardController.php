<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Operasi\DaftarTugasController;
use App\Models\DaftarTugas;
use App\Models\Kalender;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $daftarTugasController = new DaftarTugasController();
        $daftarTugas = $daftarTugasController->hitungDeadline(DaftarTugas::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->offset(0)->limit(5)->get());
        $daftarTugas = $daftarTugasController->EditFormatDeadline($daftarTugas);
        $nDaftarTugas = count(DaftarTugas::all());
        $jumlahHalaman = ceil($nDaftarTugas / 5);

        $kalender = Kalender::where('user_id', Auth::user()->id)->get();

        $jumlahPengguna = count(User::all());
        return view('admin/dashboard/index', compact('daftarTugas', 'jumlahHalaman', 'kalender', 'jumlahPengguna'));
    }

    public function root()
    {
        return redirect()->route('admin.dashboard');
    }
}
