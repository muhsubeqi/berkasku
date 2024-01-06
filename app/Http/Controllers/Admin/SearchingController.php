<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SearchingController extends Controller
{
    public function index(Request $request)
    {
        try {
            $dataValidated = $request->validate([
                'search' => 'required',
            ]);
            $search = strtolower($dataValidated['search']);

            $kategori = Kategori::where('nama_kategori', 'LIKE', "%$search%")->get();
            $data = [];
            foreach ($kategori as $k) {
                $subKategori = $k->subKategori;
                foreach ($subKategori as $sk) {
                    $dokUrl = URL::to('/administrator/dokumen');
                    $dokUrl = "$dokUrl/$sk->kategori_id/$sk->id";
                    $temp = [
                        "nama" => "$k->nama_kategori / $sk->nama_sub_kategori",
                        "url" => $dokUrl,
                    ];
                    $data[] = $temp;
                }
            }
            // foreach ($subKategori as $value) {
            //     $dokUrl = URL::to('/administrator/dokumen');
            //     $allData[] = "$dokUrl/$value->kategori_id/$value->id";
            // }

            return view('admin.searching.index', compact('data'));
        } catch (\Throwable $th) {
            $data = [];
            return view('admin.searching.index', compact('data'));
        }
    }

    public function autocomplete(Request $request)
    {
        try {
            $dataValidated = $request->validate([
                'q' => 'required',
            ]);
            $search = strtolower($dataValidated['q']);

            $kategori = Kategori::where('nama_kategori', 'LIKE', "%$search%")->get();
            $data = [];
            foreach ($kategori as $k) {
                $subKategori = $k->subKategori;
                foreach ($subKategori as $sk) {
                    $dokUrl = URL::to('/administrator/dokumen');
                    $dokUrl = "$dokUrl/$sk->kategori_id/$sk->id";
                    $temp = [
                        "label" => "$k->nama_kategori / $sk->nama_sub_kategori",
                        "value" => $dokUrl,
                    ];
                    $data[] = $temp;
                }
            }
        } catch (\Throwable $th) {
            $data = [];
        }
        return $data;

    }
}