<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::published()->latest('published_at');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        $berita = $query->paginate(9);
        $kategoris = Berita::published()->distinct()->pluck('kategori');

        return view('berita.index', compact('berita', 'kategoris'));
    }

    public function show($slug)
    {
        $berita = Berita::published()->where('slug', $slug)->firstOrFail();
        $berita->increment('views');

        $terkait = Berita::published()
            ->where('id', '!=', $berita->id)
            ->where('kategori', $berita->kategori)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('berita.show', compact('berita', 'terkait'));
    }
}
