<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publikasi;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function index()
    {
        $publikasis = Publikasi::orderByDesc('tahun')->orderBy('judul')->paginate(20);
        return view('admin.publikasi.index', compact('publikasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'required|string|max:500',
            'penulis' => 'required|string|max:300',
            'tahun'   => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'tipe'    => 'required|in:jurnal,buku,prosiding,lainnya',
            'url'     => 'nullable|url',
        ]);

        $pub = Publikasi::create($request->only(['judul', 'penulis', 'jurnal_penerbit', 'tahun', 'url', 'tipe']) + [
            'is_active' => $request->boolean('is_active', true),
        ]);

        ActivityLog::catat('tambah', 'publikasi', 'Tambah publikasi: ' . $pub->judul);
        return back()->with('success', 'Publikasi berhasil ditambahkan.');
    }

    public function update(Request $request, Publikasi $publikasi)
    {
        $request->validate([
            'judul'   => 'required|string|max:500',
            'penulis' => 'required|string|max:300',
            'tahun'   => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'tipe'    => 'required|in:jurnal,buku,prosiding,lainnya',
            'url'     => 'nullable|url',
        ]);

        $publikasi->update($request->only(['judul', 'penulis', 'jurnal_penerbit', 'tahun', 'url', 'tipe']) + [
            'is_active' => $request->boolean('is_active'),
        ]);

        ActivityLog::catat('edit', 'publikasi', 'Edit publikasi: ' . $publikasi->judul);
        return back()->with('success', 'Publikasi berhasil diperbarui.');
    }

    public function destroy(Publikasi $publikasi)
    {
        ActivityLog::catat('hapus', 'publikasi', 'Hapus publikasi: ' . $publikasi->judul);
        $publikasi->delete();
        return back()->with('success', 'Publikasi berhasil dihapus.');
    }
}
