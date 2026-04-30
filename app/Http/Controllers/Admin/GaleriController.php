<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::orderBy('urutan')->paginate(20);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'kategori'  => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
            'urutan'    => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'kategori'  => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
            'urutan'    => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($galeri->gambar);
            $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->gambar);
        $galeri->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
