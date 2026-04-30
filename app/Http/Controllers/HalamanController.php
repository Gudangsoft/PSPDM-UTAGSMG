<?php

namespace App\Http\Controllers;

use App\Models\Halaman;

class HalamanController extends Controller
{
    public function show(string $slug)
    {
        $halaman = Halaman::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('halaman.show', compact('halaman'));
    }
}
