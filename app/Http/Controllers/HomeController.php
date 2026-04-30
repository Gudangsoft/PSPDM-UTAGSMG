<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\Pejabat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $berita_terbaru = Berita::published()->latest('published_at')->take(3)->get();
        $pengumuman = Pengumuman::aktif()->latest()->take(5)->get();
        $galeri = Galeri::aktif()->take(8)->get();
        $dosen = Dosen::aktif()->take(6)->get();

        return view('home', compact('berita_terbaru', 'pengumuman', 'galeri', 'dosen'));
    }

    public function tentang()
    {
        $dosen = Dosen::aktif()->get();
        return view('tentang', compact('dosen'));
    }

    public function konsentrasi()
    {
        return view('konsentrasi');
    }

    public function profilLulusan()
    {
        return view('profil-lulusan');
    }

    public function akademik()
    {
        return view('akademik');
    }

    public function dosen()
    {
        $dosen = Dosen::aktif()->get();
        return view('dosen', compact('dosen'));
    }

    public function penelitian()
    {
        return view('penelitian');
    }

    public function struktur()
    {
        $pejabat = Pejabat::aktif()->get();
        return view('struktur', compact('pejabat'));
    }
}
