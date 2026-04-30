<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\PesanKontak;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'berita'     => Berita::count(),
            'pengumuman' => Pengumuman::count(),
            'dosen'      => Dosen::count(),
            'galeri'     => Galeri::count(),
            'pesan'      => PesanKontak::count(),
            'pesan_baru' => PesanKontak::where('is_read', false)->count(),
        ];

        $berita_terbaru = Berita::latest()->take(5)->get();
        $pesan_terbaru  = PesanKontak::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'berita_terbaru', 'pesan_terbaru'));
    }
}
