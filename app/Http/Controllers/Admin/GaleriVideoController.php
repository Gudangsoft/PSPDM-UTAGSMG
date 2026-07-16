<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriVideo;
use Illuminate\Http\Request;

class GaleriVideoController extends Controller
{
    public function index()
    {
        $videos = GaleriVideo::orderBy('urutan')->paginate(20);
        return view('admin.galeri-video.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.galeri-video.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        $platform = GaleriVideo::detectPlatform($validated['url']);
        if (!$platform) {
            return back()->withInput()->withErrors(['url' => 'Link harus berasal dari YouTube, Instagram, atau TikTok.']);
        }

        $validated['platform']  = $platform;
        $validated['urutan']    = (int) ($validated['urutan'] ?? 0);
        $validated['is_active'] = $request->boolean('is_active');

        GaleriVideo::create($validated);

        return redirect()->route('admin.galeri-video.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(GaleriVideo $galeriVideo)
    {
        return view('admin.galeri-video.edit', ['video' => $galeriVideo]);
    }

    public function update(Request $request, GaleriVideo $galeriVideo)
    {
        $validated = $this->validated($request);

        $platform = GaleriVideo::detectPlatform($validated['url']);
        if (!$platform) {
            return back()->withInput()->withErrors(['url' => 'Link harus berasal dari YouTube, Instagram, atau TikTok.']);
        }

        $validated['platform']  = $platform;
        $validated['urutan']    = (int) ($validated['urutan'] ?? $galeriVideo->urutan);
        $validated['is_active'] = $request->boolean('is_active');

        $galeriVideo->update($validated);

        return redirect()->route('admin.galeri-video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(GaleriVideo $galeriVideo)
    {
        $galeriVideo->delete();

        return back()->with('success', 'Video berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'judul'     => 'required|string|max:255',
            'url'       => 'required|url|max:500',
            'deskripsi' => 'nullable|string|max:500',
            'urutan'    => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
    }
}
