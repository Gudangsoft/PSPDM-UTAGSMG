<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;

class PesanController extends Controller
{
    public function index()
    {
        $pesan = PesanKontak::latest()->paginate(20);
        return view('admin.pesan.index', compact('pesan'));
    }

    public function show(PesanKontak $pesan)
    {
        $pesan->update(['is_read' => true]);
        return view('admin.pesan.show', compact('pesan'));
    }

    public function destroy(PesanKontak $pesan)
    {
        $pesan->delete();
        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
