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
            'gambar'    => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'kategori'  => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['gambar']    = $request->file('gambar')->store('galeri', 'public');
        $validated['urutan']    = (int) ($validated['urutan'] ?? 0);
        $validated['is_active'] = $request->boolean('is_active');

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
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'kategori'  => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar) Storage::disk('public')->delete($galeri->gambar);
            $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $validated['urutan']    = (int) ($validated['urutan'] ?? $galeri->urutan);
        $validated['is_active'] = $request->boolean('is_active');

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar) Storage::disk('public')->delete($galeri->gambar);
        $galeri->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
