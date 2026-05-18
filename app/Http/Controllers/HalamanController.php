<?php

namespace App\Http\Controllers;

use App\Models\Halaman;

class HalamanController extends Controller
{
    public function show(string $slug)
    {
        $halaman = Halaman::where('slug', $slug)->where('is_published', true)->firstOrFail();

        if ($slug === 'pendaftaran') {
            return view('halaman.pendaftaran', compact('halaman'));
        }

        return view('halaman.show', compact('halaman'));
    }
}
