<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::aktif();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $galeri = $query->paginate(12);
        $kategoris = Galeri::aktif()->distinct()->pluck('kategori');

        return view('galeri', compact('galeri', 'kategoris'));
    }
}
