<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Download;
use App\Models\Faq;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\PesanKontak;
use App\Models\Publikasi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita      = Berita::where('is_published', true)->count();
        $totalPengumuman  = Pengumuman::where('is_active', true)->count();
        $totalDosen       = Dosen::count();
        $totalGaleri      = Galeri::count();
        $totalDownload    = Download::count();
        $totalFaq         = Faq::count();
        $totalAgenda      = Agenda::aktif()->mendatang()->count();
        $totalPublikasi   = Publikasi::count();
        $pesanBelumDibaca = PesanKontak::where('is_read', false)->count();

        $beritaTerbaru  = Berita::orderByDesc('created_at')->limit(5)->get();
        $agendaMendatang = Agenda::aktif()->mendatang()->terurut()->limit(5)->get();
        $logTerbaru     = ActivityLog::with('user')->orderByDesc('created_at')->limit(8)->get();

        return view('admin.dashboard', compact(
            'totalBerita',
            'totalPengumuman',
            'totalDosen',
            'totalGaleri',
            'totalDownload',
            'totalFaq',
            'totalAgenda',
            'totalPublikasi',
            'pesanBelumDibaca',
            'beritaTerbaru',
            'agendaMendatang',
            'logTerbaru',
        ));
    }
}
