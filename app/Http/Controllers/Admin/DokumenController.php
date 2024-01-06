<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\GoogleDrive;
use App\Models\Dokumen;
use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;

class DokumenController extends Controller
{
    public function index(Kategori $kategori, SubKategori $subKategori)
    {
        return view('admin.dokumen.index', compact('kategori', 'subKategori'));

    }

    public function getData(Request $request, Kategori $kategori, SubKategori $subKategori)
    {
        $search = request('search.value');
        if ($request->ajax()) {
            $data = Dokumen::join('sub_kategori as sub', 'sub.id', '=', 'dokumen.sub_kategori_id')
                ->select('*', 'dokumen.id as dok_id', 'sub.nama_sub_kategori as nama_sub_kategori', 'dokumen.sub_sub_kategori as sub_sub_kategori', 'dokumen.nama as nama', 'dokumen.uploader as uploader');
            return DataTables::of($data)
                ->filter(function ($query) use ($search, $kategori, $subKategori) {
                    $query->where('dokumen.sub_kategori_id', $subKategori->id);
                    $query->where('sub.kategori_id', $kategori->id);
                    $query->where(function ($query) use ($search) {
                        $query->orWhere('dokumen.id', 'LIKE', "%$search%")
                            ->orWhere('sub.nama_sub_kategori', 'LIKE', "%$search%")
                            ->orWhere('dokumen.sub_sub_kategori', 'LIKE', "%$search%")
                            ->orWhere('dokumen.nama', 'LIKE', "%$search%")
                            ->orWhere('dokumen.uploader', 'LIKE', "%$search%");
                    });
                })
                ->editColumn('sub_sub_kategori', function ($row) use ($subKategori) {
                    $sub = isset($row->sub_sub_kategori) ? $row->sub_sub_kategori : 'Kosong';

                    return $sub;
                })
                ->addColumn('path', function ($row) {
                    $dokumen = isset($row->path) ? $row->path : null;
                    $url = GoogleDrive::link($dokumen);
                    $data = '';
                    if ($url != null) {
                        $data .= '
                            <a href="' . $url . '" target="_blank"><span class="btn btn-xs btn-secondary"><i class="fas fa-download mr-1"></i> Download File</span></a>
                        ';
                    } else {
                        $data .= 'Tidak Ada File';
                    }

                    return $data;
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
                                data-dok_id="' . $row->dok_id . '"
                                data-sub_sub_kategori="' . $row->sub_sub_kategori . '"
                                data-nama="' . $row->nama . '"
                                data-keterangan="' . $row->keterangan . '"
                                data-file="' . $row->file . '"
                                >Edit</button>
                            <form action="" onsubmit="deleteData(event)" method="POST">
                            ' . method_field('delete') . csrf_field() . '
                                <input type="hidden" name="id" value="' . $row->dok_id . '">
                                <input type="hidden" name="nama_kategori" value="' . $row->nama . '">
                                <button type="submit" class="dropdown-item text-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'path'])
                ->toJson();
        }
    }

    public function create(Request $request)
    {

        return view('admin.dokumen.create');
    }

    public function add(Request $request, Kategori $kategori, SubKategori $subKategori)
    {
        try {
            $dataValidated = $request->validate([
                'sub_kategori_id' => 'required',
                'sub_sub_kategori' => 'nullable',
                'nama' => 'required',
                'keterangan' => 'nullable',
            ]);

            $upload = $request['dokumen'];
            if ($request->has('dokumen')) {
                for ($i = 0; $i < count($upload); $i++) {
                    $path = GoogleDrive::getData($upload[$i]);
                    $getPath[$i] = $path['path'];
                    Dokumen::create([
                        'sub_kategori_id' => $dataValidated['sub_kategori_id'],
                        'sub_sub_kategori' => $dataValidated['sub_sub_kategori'],
                        'nama' => $dataValidated['nama'],
                        'keterangan' => $dataValidated['keterangan'],
                        'uploader' => Auth::user()->username,
                        'file' => $upload[$i],
                        'path' => $getPath[$i],
                    ]);
                }
            } else {
                Dokumen::create([
                    'sub_kategori_id' => $dataValidated['sub_kategori_id'],
                    'sub_sub_kategori' => $dataValidated['sub_sub_kategori'],
                    'nama' => $dataValidated['nama'],
                    'keterangan' => $dataValidated['keterangan'],
                    'uploader' => Auth::user()->username,
                ]);
            }

            $data = [
                "message" => 200,
                "data" => 'Berhasil menambahkan dokumen',
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
                'sub_sub_kategori_edit' => 'nullable',
                'nama_edit' => 'nullable',
                'keterangan_edit' => 'nullable',
                'dokumen_edit' => 'nullable',
            ]);

            $dokumen = Dokumen::findOrFail($dataValidated['id_edit']);
            $getFile = $request->input('file_lama');
            // $cek = $request->has('dokumen_edit');
            if ($request->has('dokumen_edit')) {
                $uploadBaru = $dataValidated['dokumen_edit'];
                $getFile = $uploadBaru;
                if ($uploadBaru) {
                    $getFileLama = Dokumen::find($dataValidated['id_edit'])->file;
                    if ($getFileLama != null) {
                        GoogleDrive::delete($getFileLama);
                    }
                }
            }
            // ambil path
            $path = GoogleDrive::getData($getFile);
            $getPath = $path['path'];

            $dokumen->update([
                'id' => $dataValidated['id_edit'],
                'sub_sub_kategori' => $dataValidated['sub_sub_kategori_edit'],
                'nama' => $dataValidated['nama_edit'],
                'keterangan' => $dataValidated['keterangan_edit'],
                'uploader' => Auth::user()->username,
                'file' => $getFile,
                'path' => $getPath,
            ]);

            $data = [
                'message' => 200,
                'data' => 'Berhasil mengedit dokumen',
            ];

            return $data;
        } catch (\Throwable $th) {
            $data = [
                'message' => 500,
                'data' => $th->getMessage(),
            ];

            return $data;
        }
    }

    public function imageUpload(Request $request)
    {
        $file = $request->file('file');
        $upload = GoogleDrive::upload($file);

        return response()->json($upload);
    }

    public function imageDelete(Request $request)
    {
        $namaFile = $request->get('dokumen');
        $delete = GoogleDrive::delete($namaFile);
        return response()->json([
            'name' => $namaFile,
        ]);
    }
    public function delete(Request $request)
    {
        try {
            $dataValidated = $request->validate([
                'id' => 'required',
            ]);

            $dokumen = Dokumen::where('id', $dataValidated['id'])->first();

            if ($dokumen->file != null) {
                GoogleDrive::delete($dokumen->file);
            }

            $dokumen->destroy($dataValidated['id']);

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