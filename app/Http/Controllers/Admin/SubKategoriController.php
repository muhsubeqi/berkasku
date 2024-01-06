<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubKategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.sub-kategori.index', compact('kategori'));
    }

    public function getData(Request $request)
    {
        $search = request('search.value');

        if ($request->ajax()) {
            $data = SubKategori::join('kategori as kat', 'kat.id', '=', 'sub_kategori.kategori_id')
                            ->select('*', 'sub_kategori.id as sub_id', 'kat.nama_kategori as nama_kategori', 'sub_kategori.nama_sub_kategori');
            return DataTables::of($data)
                ->filter(function ($query) use ($search) {
                    $query->orWhere('sub_kategori.id', 'LIKE', "%$search%")
                        ->orWhere('kat.nama_kategori', 'LIKE', "%$search%")
                        ->orWhere('sub_kategori.nama_sub_kategori', 'LIKE', "%$search%");
                })
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
                                data-sub_id="' . $row->sub_id . '"
                                data-kategori_id="' . $row->kategori_id . '"
                                data-nama_sub_kategori="' . $row->nama_sub_kategori . '"
                                >Edit</button>
                            <form action="" onsubmit="deleteData(event)" method="POST">
                            ' . method_field('delete') . csrf_field() . '
                                <input type="hidden" name="id" value="' . $row->sub_id . '">
                                <input type="hidden" name="nama_sub_kategori" value="' . $row->nama_sub_kategori . '">
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
                'kategori_id' => 'required',
                'nama_sub_kategori' => 'required',
            ]);

            SubKategori::create([
                'kategori_id' => $dataValidated['kategori_id'],
                'nama_sub_kategori' => $dataValidated['nama_sub_kategori'],
            ]);

            $data = [
                "message" => 200,
                "data" => "Berhasil Menambahkan Data Sub Kategori",
            ];
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
                'kategori_id_edit' => 'required',
                'nama_sub_kategori_edit' => 'required',
            ]);
            $subKategori = SubKategori::findOrFail($dataValidated['id_edit']);
            $subKategori->update([
                'kategori_id' => $dataValidated['kategori_id_edit'],
                'nama_sub_kategori' => $dataValidated['nama_sub_kategori_edit'],
            ]);
            $data = [
                "message" => 200,
                "data" => "Berhasil Mengedit Data Sub Kategori",
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

            SubKategori::destroy($dataValidated['id']);

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