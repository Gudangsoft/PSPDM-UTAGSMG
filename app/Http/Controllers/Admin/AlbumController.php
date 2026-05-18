<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::withCount('galeri')->orderBy('urutan')->paginate(20);
        return view('admin.album.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.album.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug']      = Str::slug($validated['nama']) . '-' . Str::random(5);
        $validated['urutan']    = (int) ($validated['urutan'] ?? 0);
        $validated['is_active'] = $request->boolean('is_active');

        Album::create($validated);

        return redirect()->route('admin.album.index')->with('success', 'Album berhasil dibuat.');
    }

    public function edit(Album $album)
    {
        $fotos = $album->galeri()->paginate(24);
        return view('admin.album.edit', compact('album', 'fotos'));
    }

    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['urutan']    = (int) ($validated['urutan'] ?? $album->urutan);
        $validated['is_active'] = $request->boolean('is_active');

        $album->update($validated);

        return redirect()->route('admin.album.edit', $album)->with('success', 'Album berhasil diperbarui.');
    }

    public function destroy(Album $album)
    {
        foreach ($album->galeri as $foto) {
            if ($foto->gambar) Storage::disk('public')->delete($foto->gambar);
            $foto->delete();
        }
        if ($album->cover_foto) Storage::disk('public')->delete($album->cover_foto);
        $album->delete();

        return redirect()->route('admin.album.index')->with('success', 'Album dan semua foto berhasil dihapus.');
    }

    public function bulkUpload(Request $request, Album $album)
    {
        $request->validate([
            'fotos'   => 'required|array|min:1',
            'fotos.*' => 'image|mimes:jpg,jpeg,png,webp',
        ]);

        $judul    = $request->input('judul_prefix', $album->nama);
        $kategori = $request->input('kategori', 'Kegiatan');
        $uploaded = 0;

        foreach ($request->file('fotos') as $i => $file) {
            $path = $this->compressAndStore($file);
            Galeri::create([
                'album_id'  => $album->id,
                'judul'     => $judul . ' ' . ($i + 1),
                'gambar'    => $path,
                'kategori'  => $kategori,
                'urutan'    => $i,
                'is_active' => true,
            ]);
            // Set first photo as cover if no cover yet
            if ($uploaded === 0 && !$album->cover_foto) {
                $album->update(['cover_foto' => $path]);
            }
            $uploaded++;
        }

        return redirect()->route('admin.album.edit', $album)
            ->with('success', "{$uploaded} foto berhasil diupload ke album.");
    }

    // AJAX: upload satu foto per request
    public function uploadOne(Request $request, Album $album)
    {
        $request->validate([
            'foto'     => 'required|image|mimes:jpg,jpeg,png,webp',
            'judul'    => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:50',
        ]);

        try {
            $path = $this->compressAndStore($request->file('foto'));

            $galeri = Galeri::create([
                'album_id'  => $album->id,
                'judul'     => $request->input('judul', $album->nama),
                'gambar'    => $path,
                'kategori'  => $request->input('kategori', 'Kegiatan'),
                'urutan'    => 0,
                'is_active' => true,
            ]);

            if (!$album->cover_foto) {
                $album->update(['cover_foto' => $path]);
            }

            return response()->json([
                'ok'  => true,
                'url' => asset('storage/' . $path),
                'id'  => $galeri->id,
            ]);
        } catch (\Throwable $e) {
            return response()->json(['ok' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function destroyFoto(Album $album, Galeri $galeri)
    {
        if ($galeri->gambar) Storage::disk('public')->delete($galeri->gambar);
        if ($album->cover_foto === $galeri->gambar) {
            $album->update(['cover_foto' => null]);
        }
        $galeri->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function setCover(Album $album, Galeri $galeri)
    {
        $album->update(['cover_foto' => $galeri->gambar]);
        return back()->with('success', 'Cover album diperbarui.');
    }

    private function compressAndStore(UploadedFile $file): string
    {
        $mime = $file->getMimeType();

        $src = match (true) {
            str_contains($mime, 'png')  => imagecreatefrompng($file->getRealPath()),
            str_contains($mime, 'webp') => imagecreatefromwebp($file->getRealPath()),
            default                     => imagecreatefromjpeg($file->getRealPath()),
        };

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
