<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\DownloadKategori;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads  = Download::orderBy('urutan')->orderBy('judul')->paginate(20);
        $kategoris  = DownloadKategori::terurut()->get();
        return view('admin.download.index', compact('downloads', 'kategoris'));
    }

    // ── Kategori CRUD ──────────────────────────────────────────

    public function storeKategori(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:80|unique:download_kategoris,nama']);
        DownloadKategori::create([
            'nama'      => $request->nama,
            'urutan'    => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);
        return back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function updateKategori(Request $request, DownloadKategori $kategori)
    {
        $request->validate(['nama' => 'required|string|max:80|unique:download_kategoris,nama,' . $kategori->id]);
        $old = $kategori->nama;
        $kategori->update([
            'nama'      => $request->nama,
            'urutan'    => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);
        // Sync nama on download rows
        if ($old !== $request->nama) {
            Download::where('kategori', $old)->update(['kategori' => $request->nama]);
        }
        return back()->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroyKategori(DownloadKategori $kategori)
    {
        if (Download::where('kategori', $kategori->nama)->exists()) {
            return back()->withErrors(['kategori' => 'Kategori masih digunakan oleh ' . Download::where('kategori', $kategori->nama)->count() . ' file.']);
        }
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'file'      => 'required|file|max:20480',
            'kategori'  => 'required|string|max:80',
            'urutan'    => 'nullable|integer',
        ]);

        $file = $request->file('file');
        $path = $file->store('downloads', 'public');
        $ukuran = $this->formatSize($file->getSize());

        $dl = Download::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file'      => $path,
            'ukuran'    => $ukuran,
            'kategori'  => $request->kategori,
            'urutan'    => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        ActivityLog::catat('tambah', 'download', 'Tambah download: ' . $dl->judul);
        return back()->with('success', 'File berhasil ditambahkan.');
    }

    public function update(Request $request, Download $download)
    {
        $request->validate([
            'judul'    => 'required|string|max:200',
            'kategori' => 'required|string|max:80',
            'file'     => 'nullable|file|max:20480',
            'urutan'   => 'nullable|integer',
        ]);

        $data = [
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori'  => $request->kategori,
            'urutan'    => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($download->file);
            $file = $request->file('file');
            $data['file']   = $file->store('downloads', 'public');
            $data['ukuran'] = $this->formatSize($file->getSize());
        }

        $download->update($data);
        ActivityLog::catat('edit', 'download', 'Edit download: ' . $download->judul);
        return back()->with('success', 'File berhasil diperbarui.');
    }

    public function destroy(Download $download)
    {
        Storage::disk('public')->delete($download->file);
        ActivityLog::catat('hapus', 'download', 'Hapus download: ' . $download->judul);
        $download->delete();
        return back()->with('success', 'File berhasil dihapus.');
    }

    private function formatSize(int $bytes): string
    {
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024)    return round($bytes / 1024, 0)    . ' KB';
        return $bytes . ' B';
    }
}
