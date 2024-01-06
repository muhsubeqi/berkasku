<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        return view('admin.kategori.index');
    }

    public function getData(Request $request)
    {
        $search = request('search.value');

        if ($request->ajax()) {
            $data = Kategori::select('*');
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Klik
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button type="button" class="dropdown-item"
                                data-toggle="modal" data-target="#modal_edit"
                                data-id="' . $row->id . '"
                                data-nama_kategori="' . $row->nama_kategori . '"
                                data-ikon="' . $row->ikon . '"
                                >Edit</button>
                            <form action="" onsubmit="deleteData(event)" method="POST">
                            ' . method_field('delete') . csrf_field() . '
                                <input type="hidden" name="id" value="' . $row->id . '">
                                <input type="hidden" name="nama_kategori" value="' . $row->nama_kategori . '">
                                <button type="submit" class="dropdown-item text-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    public function add(Request $request)
    {
        try {
            $dataValidated = $request->validate([
                'nama_kategori' => 'required',
                'ikon' => 'nullable',
            ]);

            $cek = Kategori::where('nama_kategori', $dataValidated['nama_kategori'])->first();
            if ($cek == null) {
                Kategori::create([
                    'nama_kategori' => $dataValidated['nama_kategori'],
                    'ikon' => $dataValidated['ikon'],
                ]);

                $data = [
                    "message" => 200,
                    "data" => "Berhasil Menambahkan Data Kategori",
                ];
            } else {
                $data = [
                    "message" => 500,
                    "data" => "Data Kategori Sudah Ada",
                ];
            }

        } catch (\Throwable $th) {
            $data = [
                "message" => 500,
                "data" => $th->getMessage(),
            ];
        }
        return $data;
    }

    public function edit(Request $request)
    {
        try {
            $dataValidated = $request->validate([
                'id_edit' => 'required',
                'nama_kategori_edit' => 'required',
                'ikon_edit' => 'required',
            ]);
            $kategori = Kategori::findOrFail($dataValidated['id_edit']);
            $kategori->update([
                'nama_kategori' => $dataValidated['nama_kategori_edit'],
                'ikon' => $dataValidated['ikon_edit'],
            ]);
            $data = [
                "message" => 200,
                "data" => "Berhasil edit data",
            ];
        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                "message" => 500,
                "data" => $th->getMessage(),
            ];
        }
        return $data;
    }

    public function delete(Request $request)
    {
        try {
            $dataValidated = $request->validate([
                'id' => 'required',
            ]);

            Kategori::destroy($dataValidated['id']);

            $data = [
                "message" => 200,
                "data" => "Berhasil menghapus data",
            ];
            return $data;
        } catch (\Throwable $th) {
            $data = [
                "message" => 500,
                "data" => $th->getMessage(),
            ];
            return $data;
        }
    }
}
