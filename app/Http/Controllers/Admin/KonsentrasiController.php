<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsentrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KonsentrasiController extends Controller
{
    public function index()
    {
        $konsentrasis = Konsentrasi::orderBy('urutan')->get();
        return view('admin.konsentrasi.index', compact('konsentrasis'));
    }

    public function create()
    {
        return view('admin.konsentrasi.form', ['konsentrasi' => new Konsentrasi]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['topik'] = $this->parseTopik($request->input('topik_raw', ''));

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('konsentrasi', 'public');
        }

        Konsentrasi::create($data);

        return redirect()->route('admin.konsentrasi.index')
            ->with('success', 'Konsentrasi berhasil ditambahkan.');
    }

    public function edit(Konsentrasi $konsentrasi)
    {
        return view('admin.konsentrasi.form', compact('konsentrasi'));
    }

    public function update(Request $request, Konsentrasi $konsentrasi)
    {
        $data = $this->validated($request);
        $data['topik'] = $this->parseTopik($request->input('topik_raw', ''));

        if ($request->hasFile('gambar')) {
            if ($konsentrasi->gambar) {
                Storage::disk('public')->delete($konsentrasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('konsentrasi', 'public');
        }

        $konsentrasi->update($data);

        return redirect()->route('admin.konsentrasi.index')
            ->with('success', 'Konsentrasi berhasil diperbarui.');
    }

    public function destroy(Konsentrasi $konsentrasi)
    {
        if ($konsentrasi->gambar) {
            Storage::disk('public')->delete($konsentrasi->gambar);
        }
        $konsentrasi->delete();
        return redirect()->route('admin.konsentrasi.index')
            ->with('success', 'Konsentrasi berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama'               => 'required|string|max:200',
            'nama_en'            => 'nullable|string|max:200',
            'gambar'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'warna_primer'       => 'nullable|string|max:20',
            'warna_sekunder'     => 'nullable|string|max:20',
            'deskripsi'          => 'required|string',
            'deskripsi_lanjutan' => 'nullable|string',
            'urutan'             => 'required|integer|min:0|max:255',
            'is_active'          => 'boolean',
        ], [
            'gambar.max'   => 'Ukuran gambar maksimal 2 MB.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus JPG, PNG, atau WEBP.',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }

    private function parseTopik(string $raw): array
    {
        return array_values(array_filter(
            array_map('trim', explode("\n", str_replace("\r", '', $raw)))
        ));
    }
}
