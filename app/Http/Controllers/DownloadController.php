<?php

namespace App\Http\Controllers;

use App\Models\Download;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::aktif()->terurut()->get()->groupBy('kategori');
        return view('download', compact('downloads'));
    }

    public function unduh(Download $download)
    {
        abort_unless($download->is_active, 404);
        return response()->download(storage_path('app/public/' . $download->file));
    }
}
