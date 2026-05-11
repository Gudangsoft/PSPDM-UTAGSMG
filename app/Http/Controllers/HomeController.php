<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Galeri;
use App\Models\Halaman;
use App\Models\JadwalPmb;
use App\Models\Konsentrasi;
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
        $konsentrasis = Konsentrasi::aktif()->get();
        return view('konsentrasi', compact('konsentrasis'));
    }

    public function profilLulusan()
    {
        return view('profil-lulusan');
    }

    public function akademik()
    {
        $halamanMap = Halaman::whereIn('slug', [
                'akademik-kurikulum',
                'akademik-syarat-pendaftaran',
            ])
            ->where('is_published', true)
            ->get()
            ->keyBy('slug');

        $jadwals = JadwalPmb::aktif()->get();

        return view('akademik', compact('halamanMap', 'jadwals'));
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

    public function biaya()
    {
        $halaman = Halaman::where('slug', 'biaya-pendidikan')
            ->where('is_published', true)
            ->firstOrFail();
        return view('biaya', compact('halaman'));
    }
}
