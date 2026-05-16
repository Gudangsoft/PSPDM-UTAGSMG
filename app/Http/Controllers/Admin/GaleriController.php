<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        \Log::info('GALERI STORE', [
            'has_file'  => $request->hasFile('gambar'),
            'file_size' => $request->hasFile('gambar') ? $request->file('gambar')->getSize() : null,
            'file_err'  => $request->hasFile('gambar') ? $request->file('gambar')->getError() : null,
        ]);

        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png,webp',
            'kategori'  => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['gambar']    = $this->compressAndStore($request->file('gambar'));
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
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'kategori'  => 'required|string|max:50',
            'deskripsi' => 'nullable|string|max:500',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar) Storage::disk('public')->delete($galeri->gambar);
            $validated['gambar'] = $this->compressAndStore($request->file('gambar'));
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

    // Compress & resize image using GD, save as JPEG quality 82, max 1920px wide
    private function compressAndStore(UploadedFile $file): string
    {
        $mime = $file->getMimeType();

        $src = match (true) {
            str_contains($mime, 'png')  => imagecreatefrompng($file->getRealPath()),
            str_contains($mime, 'webp') => imagecreatefromwebp($file->getRealPath()),
            default                     => imagecreatefromjpeg($file->getRealPath()),
        };

        // Preserve transparency for PNG
        if (str_contains($mime, 'png')) {
            $bg = imagecreatetruecolor(imagesx($src), imagesy($src));
            imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
            imagecopy($bg, $src, 0, 0, 0, 0, imagesx($src), imagesy($src));
            imagedestroy($src);
            $src = $bg;
        }

        $origW = imagesx($src);
        $origH = imagesy($src);
        $maxW  = 1920;

        // Resize only if wider than maxW
        if ($origW > $maxW) {
            $newH = (int) round($origH * $maxW / $origW);
            $dst  = imagecreatetruecolor($maxW, $newH);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $maxW, $newH, $origW, $origH);
            imagedestroy($src);
            $src = $dst;
        }

        $filename = 'galeri/' . Str::uuid() . '.jpg';
        $fullPath = Storage::disk('public')->path($filename);

        Storage::disk('public')->makeDirectory('galeri');
        imagejpeg($src, $fullPath, 82);
        imagedestroy($src);

        return $filename;
    }
}
