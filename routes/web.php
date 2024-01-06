<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DokumenCloneController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\SearchingController;
use App\Http\Controllers\Admin\SubKategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Operasi\DaftarTugasController;
use App\Http\Controllers\Operasi\KalenderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Auth::routes();
Auth::routes([
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    'register' => false
]);

Route::get('/', [HomeController::class, 'root'])->name('root');
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/logged', [HomeController::class, 'logged'])->name('logged');
// Route::get('/testes', [HomeController::class, 'testes'])->name('testes');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'administrator', 'middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'root'])->name('admin.dashboard.root');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('kategori')->group(function () {
        // Kategori
        Route::get('/', [KategoriController::class, 'index'])->name('admin.master.kategori');
        Route::get('/data-kategori', [KategoriController::class, 'getData'])->name('admin.master.kategori.data');
        Route::post('/add', [KategoriController::class, 'add'])->name('admin.master.kategori.add');
        Route::post('/edit', [KategoriController::class, 'edit'])->name('admin.master.kategori.edit');
        Route::delete('/delete', [KategoriController::class, 'delete'])->name('admin.master.kategori.delete');
    });

    Route::prefix('sub-kategori')->group(function () {
        // Sub Kategori
        Route::get('/', [SubKategoriController::class, 'index'])->name('admin.master.sub-kategori');
        Route::get('/data-sub-kategori', [SubKategoriController::class, 'getData'])->name('admin.master.sub-kategori.data');
        Route::post('/add', [SubKategoriController::class, 'add'])->name('admin.master.sub-kategori.add');
        Route::post('/edit', [SubKategoriController::class, 'edit'])->name('admin.master.sub-kategori.edit');
        Route::delete('/delete', [SubKategoriController::class, 'delete'])->name('admin.master.sub-kategori.delete');
    });

    Route::prefix('dokumen')->group(function () {
        // Dokumen
        Route::get('/create', [DokumenController::class, 'create'])->name('admin.dokumen.create');

        // dinamis
        Route::get('/{kategori}/{subKategori}/', [DokumenController::class, 'index'])->name('admin.dokumen.index');

        // getData with Modal
        Route::get('/getdata/{kategori}/{subKategori}', [DokumenController::class, 'getData'])->name('admin.dokumen.data');
        Route::post('/add', [DokumenController::class, 'add'])->name('admin.dokumen.add');
        Route::post('/edit', [DokumenController::class, 'edit'])->name('admin.dokumen.edit');
        Route::delete('/delete', [DokumenController::class, 'delete'])->name('admin.dokumen.delete');

        // Upload Image Dropzone
        Route::post('/upload-image', [DokumenController::class, 'imageUpload'])->name('admin.dokumen.imageUpload');
        Route::post('/delete-image', [DokumenController::class, 'imageDelete'])->name('admin.dokumen.imageDelete');
        // Upload Image Dropzone Edit
        Route::post('/upload-image-edit', [DokumenController::class, 'imageUploadEdit'])->name('admin.dokumen.imageUploadEdit');
        Route::post('/delete-image-edit', [DokumenController::class, 'imageDeleteEdit'])->name('admin.dokumen.imageDeleteEdit');
    });

    Route::prefix('profil')->group(function () {
        Route::get('/', [ProfilController::class, 'index'])->name('admin.profil');
    });

    Route::prefix('searching')->middleware('auth')->group(function () {
        Route::get('/', [SearchingController::class, 'index'])->name('admin.searching');
        Route::get('/autocomplete', [SearchingController::class, 'autocomplete'])->name('admin.searching.autocomplete');
    });

});

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('operasi')->group(function () {
        // admin
        Route::prefix('daftar-tugas')->group(function () {
            Route::get('/', [DaftarTugasController::class, 'show'])->name('operasi.daftarTugas.show');
            Route::post('/tambah', [DaftarTugasController::class, 'tambah'])->name('operasi.daftarTugas.tambah');
            Route::post('/edit', [DaftarTugasController::class, 'edit'])->name('operasi.daftarTugas.edit');
            Route::get('/jumlah-halaman', [DaftarTugasController::class, 'jumlahHalaman'])->name('operasi.daftarTugas.jumlahHalaman');
            Route::get('/{offset}', [DaftarTugasController::class, 'daftarTugas'])->name('operasi.daftarTugas');
            Route::get('/{id}/edit/{status}', [DaftarTugasController::class, 'check'])->name('operasi.daftarTugas.check');
            Route::post('/{id}/hapus', [DaftarTugasController::class, 'hapus'])->name('operasi.daftarTugas.hapus');
        });

        Route::prefix('kalender')->group(function () {
            Route::get('/', [KalenderController::class, 'show'])->name('operasi.kalender');
            Route::post('/tambah', [KalenderController::class, 'tambah'])->name('operasi.kalender.tambah');
            Route::post('/{id}/edit', [KalenderController::class, 'edit'])->name('operasi.kalender.edit');
            Route::delete('/{id}/hapus', [KalenderController::class, 'hapus'])->name('operasi.kalender.hapus');
        });

    });
});