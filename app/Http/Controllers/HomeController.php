<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\RisetUnggulan;
use App\Models\Download;
use App\Models\Dosen;
use App\Models\Galeri;
use App\Models\GaleriVideo;
use App\Models\Halaman;
use App\Models\JadwalPmb;
use App\Models\Konsentrasi;
use App\Models\Pengumuman;
use App\Models\JadwalAkademik;
use App\Models\Kurikulum;
use App\Models\Pejabat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $berita_terbaru = Berita::published()->latest('published_at')->take(3)->get();
        $pengumuman     = Pengumuman::aktif()->latest()->take(5)->get();
        $galeri         = Galeri::aktif()->take(8)->get();
        $galeriVideo    = GaleriVideo::aktif()->take(4)->get();
        $dosen          = Dosen::aktif()->take(6)->get();
        $brosur         = Download::aktif()->where('kategori', 'Brosur')->terurut()->get();
        $konsentrasis   = Konsentrasi::aktif()->get();

        return view('home', compact('berita_terbaru', 'pengumuman', 'galeri', 'galeriVideo', 'dosen', 'brosur', 'konsentrasis'));
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

    public function dosenShow(Dosen $dosen)
    {
        abort_unless($dosen->is_active, 404);
        return view('dosen-show', compact('dosen'));
    }

    public function penelitian()
    {
        try {
            $riset = RisetUnggulan::aktif()->get();
        } catch (\Exception $e) {
            $riset = collect();
        }
        return view('penelitian', compact('riset'));
    }

    public function struktur()
    {
        $pejabat   = Pejabat::aktif()->get();
        $kurikulum = Kurikulum::aktif()->get();
        return view('struktur', compact('pejabat', 'kurikulum'));
    }

    public function jadwalAkademik()
    {
        $jadwal  = JadwalAkademik::aktif()->get();
        $grouped = $jadwal->groupBy(fn($j) => $j->tahun_akademik . '|' . $j->semester);
        return view('jadwal-akademik', compact('jadwal', 'grouped'));
    }

    public function biaya()
    {
        $halaman = Halaman::where('slug', 'biaya-pendidikan')
            ->where('is_published', true)
            ->firstOrFail();
        return view('biaya', compact('halaman'));
    }
}
