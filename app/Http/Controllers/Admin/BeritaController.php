<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::latest()->paginate(15);
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'kategori'     => 'required|string|max:50',
            'ringkasan'    => 'nullable|string|max:500',
            'konten'       => 'required|string',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'penulis'      => 'required|string|max:100',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $validated['slug'] = Str::slug($validated['judul']);
        if ($request->boolean('is_published')) {
            $validated['published_at'] = now();
        }

        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $beritum)
    {
        return view('admin.berita.edit', ['berita' => $beritum]);
    }

    public function update(Request $request, Berita $beritum)
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'kategori'     => 'required|string|max:50',
            'ringkasan'    => 'nullable|string|max:500',
            'konten'       => 'required|string',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'penulis'      => 'required|string|max:100',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($beritum->gambar) {
                Storage::disk('public')->delete($beritum->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $validated['slug'] = Str::slug($validated['judul']);
        if ($request->boolean('is_published') && !$beritum->published_at) {
            $validated['published_at'] = now();
        }

        $beritum->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->gambar) {
            Storage::disk('public')->delete($beritum->gambar);
        }
        $beritum->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }
}
