<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Halaman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HalamanController extends Controller
{
    public function index()
    {
        $halaman = Halaman::orderBy('urutan')->orderBy('judul')->get();
        return view('admin.halaman.index', compact('halaman'));
    }

    public function create()
    {
        return view('admin.halaman.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'          => 'required|string|max:200',
            'konten'         => 'nullable|string',
            'meta_deskripsi' => 'nullable|string|max:300',
            'is_published'   => 'boolean',
            'urutan'         => 'required|integer|min:0',
        ]);

        if (isset($data['konten'])) {
            $data['konten'] = $this->sanitizeHtml($data['konten']);
        }
        $data['slug']         = $this->uniqueSlug(Str::slug($data['judul']));
        $data['is_published'] = $request->boolean('is_published');

        Halaman::create($data);

        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil dibuat.');
    }

    public function edit(Halaman $halaman)
    {
        return view('admin.halaman.edit', compact('halaman'));
    }

    public function update(Request $request, Halaman $halaman)
    {
        $data = $request->validate([
            'judul'          => 'required|string|max:200',
            'konten'         => 'nullable|string',
            'meta_deskripsi' => 'nullable|string|max:300',
            'is_published'   => 'boolean',
            'urutan'         => 'required|integer|min:0',
        ]);

        $newSlug = Str::slug($data['judul']);
        if (isset($data['konten'])) {
            $data['konten'] = $this->sanitizeHtml($data['konten']);
        }
        if ($newSlug !== $halaman->slug) {
            $data['slug'] = $this->uniqueSlug($newSlug, $halaman->id);
        }

        $data['is_published'] = $request->boolean('is_published');

        $halaman->update($data);

        return redirect()->route('admin.halaman.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Halaman $halaman)
    {
        $halaman->delete();
        return back()->with('success', 'Halaman berhasil dihapus.');
    }

    private function sanitizeHtml(?string $html): ?string
    {
        if (empty($html)) return $html;
        $html = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $html);
        $html = preg_replace('/<(iframe|object|embed|applet)\b[^>]*>.*?<\/\1>/is', '', $html);
        $html = preg_replace('/<(iframe|object|embed|applet)\b[^>]*\/?>/i', '', $html);
        $html = preg_replace('/\s+on[a-z]+\s*=\s*(?:"[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);
        $html = preg_replace('/(href|src|action)\s*=\s*(["\'])\s*(?:javascript|vbscript)\s*:/i', '$1=$2#', $html);
        return $html;
    }

    private function uniqueSlug(string $slug, int $excludeId = 0): string
    {
        $original = $slug;
        $i = 1;
        while (Halaman::where('slug', $slug)->where('id', '!=', $excludeId)->exists()) {
            $slug = $original . '-' . $i++;
        }
        return $slug;
    }
}
