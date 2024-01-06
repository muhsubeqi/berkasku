<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('dalwa123'),
                'role' => 'admin',
            ],
            [
                'username' => 'admin1',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('dalwa123'),
                'role' => 'admin',
            ],
            [
                'username' => 'kepala',
                'email' => 'kepala@gmail.com',
                'password' => Hash::make('dalwa123'),
                'role' => 'kepala',
            ],
        ]);

        DB::table('kategori')->insert([
            [
                'nama_kategori' => 'Profile',
                'ikon' => 'fa-school',
            ],
            [
                'nama_kategori' => 'VMTS',
                'ikon' => 'fa-newspaper',
            ],
            [
                'nama_kategori' => 'PTK',
                'ikon' => 'fa-desktop',
            ],
            [
                'nama_kategori' => 'Mahasiswa',
                'ikon' => 'fa-user-graduate',
            ],
            [
                'nama_kategori' => 'SDM',
                'ikon' => 'fa-suitcase',
            ],
            [
                'nama_kategori' => 'Keuangan',
                'ikon' => 'fa-wallet',
            ],
            [
                'nama_kategori' => 'Pendidikan',
                'ikon' => 'fa-graduation-cap',
            ],
            [
                'nama_kategori' => 'Penelitian',
                'ikon' => 'fa-laptop',
            ],
            [
                'nama_kategori' => 'PKM',
                'ikon' => 'fa-file',
            ],
            [
                'nama_kategori' => 'Monev',
                'ikon' => 'fa-clipboard',
            ],
            [
                'nama_kategori' => 'Kerjasama',
                'ikon' => 'fa-network-wired',
            ],
            [
                'nama_kategori' => 'Bahan Ajar',
                'ikon' => 'fa-book',
            ],
            [
                'nama_kategori' => 'Pedoman',
                'ikon' => 'fa-info',
            ],
        ]);

        DB::table('sub_kategori')->insert([
            [
                'kategori_id' => 1,
                'nama_sub_kategori' => 'SK',
            ],
            [
                'kategori_id' => 1,
                'nama_sub_kategori' => 'SK Tim Pelaksana RKT',
            ],
            [
                'kategori_id' => 1,
                'nama_sub_kategori' => 'Struktur Organisasi',
            ],
            [
                'kategori_id' => 1,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            [
                'kategori_id' => 2,
                'nama_sub_kategori' => 'Berita Acara',
            ],
            [
                'kategori_id' => 2,
                'nama_sub_kategori' => 'Monev',
            ],
            [
                'kategori_id' => 2,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            [
                'kategori_id' => 2,
                'nama_sub_kategori' => 'SK',
            ],
            [
                'kategori_id' => 3,
                'nama_sub_kategori' => 'Latar Belakang',
            ],
            [
                'kategori_id' => 3,
                'nama_sub_kategori' => 'Kebijakan',
            ],
            [
                'kategori_id' => 3,
                'nama_sub_kategori' => 'Evaluasi Capaian Kinerja',
            ],
            [
                'kategori_id' => 3,
                'nama_sub_kategori' => 'Indikator Kinerja Utama',
            ],
            [
                'kategori_id' => 3,
                'nama_sub_kategori' => 'Kepuasan Pengguna',
            ],
            [
                'kategori_id' => 3,
                'nama_sub_kategori' => 'Penjaminan Mutu',
            ],
            [
                'kategori_id' => 3,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            //
            [
                'kategori_id' => 4,
                'nama_sub_kategori' => 'Kebijakan',
            ],
            [
                'kategori_id' => 4,
                'nama_sub_kategori' => 'Kepuasan Pengguna',
            ],
            [
                'kategori_id' => 4,
                'nama_sub_kategori' => 'Latar Belakang',
            ],
            [
                'kategori_id' => 4,
                'nama_sub_kategori' => 'Layanan Kemahasiswaan',
            ],
            [
                'kategori_id' => 4,
                'nama_sub_kategori' => 'Seleksi Mahasiswa',
            ],
            [
                'kategori_id' => 4,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            //
            [
                'kategori_id' => 5,
                'nama_sub_kategori' => 'Evaluasi Capaian Kinerja',
            ],
            [
                'kategori_id' => 5,
                'nama_sub_kategori' => 'Indikator Kinerja',
            ],
            [
                'kategori_id' => 5,
                'nama_sub_kategori' => 'Indikator Kinerja Utama',
            ],
            [
                'kategori_id' => 5,
                'nama_sub_kategori' => 'Kebijakan',
            ],
            [
                'kategori_id' => 5,
                'nama_sub_kategori' => 'Kepuasan Pengguna Bidang SDM',
            ],
            [
                'kategori_id' => 5,
                'nama_sub_kategori' => 'Latar Belakang',
            ],
            [
                'kategori_id' => 5,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            //
            [
                'kategori_id' => 6,
                'nama_sub_kategori' => 'Evaluasi Capaian Kinerja',
            ],
            [
                'kategori_id' => 6,
                'nama_sub_kategori' => 'Indikator Kinerja Utama',
            ],
            [
                'kategori_id' => 6,
                'nama_sub_kategori' => 'Latar Belakang',
            ],
            [
                'kategori_id' => 6,
                'nama_sub_kategori' => 'Strategi Pencapaian Standar',
            ],
            [
                'kategori_id' => 6,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            //
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'Evaluasi Capaian Kinerja',
            ],
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'Indikator Kinerja Utama',
            ],
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'Kebijakan',
            ],
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'Kepuasan Pengguna',
            ],
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'Latar Belakang',
            ],
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'Strategi Pencapaian',
            ],
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'Kurikulum',
            ],
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'RPS',
            ],
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'Sebaran Mata Kuliah',
            ],
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'Prestasi Akademik',
            ],
            [
                'kategori_id' => 7,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            //
            [
                'kategori_id' => 8,
                'nama_sub_kategori' => 'Evaluasi Capaian Kinerja',
            ],
            [
                'kategori_id' => 8,
                'nama_sub_kategori' => 'Kebijakan',
            ],
            [
                'kategori_id' => 8,
                'nama_sub_kategori' => 'Kepuasan Pengguna',
            ],
            [
                'kategori_id' => 8,
                'nama_sub_kategori' => 'Latar Belakang',
            ],
            [
                'kategori_id' => 8,
                'nama_sub_kategori' => 'Strategi Pencapaian',
            ],
            [
                'kategori_id' => 8,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            //
            [
                'kategori_id' => 9,
                'nama_sub_kategori' => 'Evaluasi Capaian Kinerja',
            ],
            [
                'kategori_id' => 9,
                'nama_sub_kategori' => 'Kebijakan',
            ],
            [
                'kategori_id' => 9,
                'nama_sub_kategori' => 'Kepuasan Pengguna',
            ],
            [
                'kategori_id' => 9,
                'nama_sub_kategori' => 'Latar Belakang',
            ],
            [
                'kategori_id' => 9,
                'nama_sub_kategori' => 'Strategi Pencapaian',
            ],
            [
                'kategori_id' => 9,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            //
            [
                'kategori_id' => 10,
                'nama_sub_kategori' => 'Karya Tulis Dosen',
            ],
            [
                'kategori_id' => 10,
                'nama_sub_kategori' => 'Karya Tulis Mahasiswa',
            ],
            [
                'kategori_id' => 10,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            //
            [
                'kategori_id' => 11,
                'nama_sub_kategori' => 'Monev Mitra Kerjasama',
            ],
            [
                'kategori_id' => 11,
                'nama_sub_kategori' => 'Monev Mitra Pendidikan',
            ],
            [
                'kategori_id' => 11,
                'nama_sub_kategori' => 'Monev Penelitian',
            ],
            [
                'kategori_id' => 11,
                'nama_sub_kategori' => 'Monev Pengabdian',
            ],
            [
                'kategori_id' => 11,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            //
            [
                'kategori_id' => 12,
                'nama_sub_kategori' => 'Kerjasama Pendidikan',
            ],
            [
                'kategori_id' => 12,
                'nama_sub_kategori' => 'Kerjasama Penelitian',
            ],
            [
                'kategori_id' => 12,
                'nama_sub_kategori' => 'Kerjasama PKM',
            ],
            [
                'kategori_id' => 12,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
            [
                'kategori_id' => 13,
                'nama_sub_kategori' => 'Lain-Lain',
            ],
        ]);
    }
}