<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\GoogleDrive;
use Illuminate\Http\Request;

class TesController extends Controller
{
    public function index()
    {
        return view('admin.galery.index');
    }
    public function create()
    {
        // $categories = CategoryPhoto::all();
        return view('admin.galery.create');
    }

    public function imageUpload(Request $request)
    {
        $image = $request->file('file');
        $upload = GoogleDrive::upload($image);
        return response()->json($upload);
    }

    public function imageDelete(Request $request)
    {
        $namaFile = $request->get('photo');
        $delete = GoogleDrive::delete($namaFile);
        return response()->json([
            'name' => $namaFile,
        ]);
    }
}