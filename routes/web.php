<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SambutanController;
use App\Http\Controllers\Admin\HalamanController as AdminHalamanController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PejabatController as AdminPejabatController;
use App\Http\Controllers\Admin\BerandaController as AdminBerandaController;
use App\Http\Controllers\Admin\JadwalPmbController;
use App\Http\Controllers\Admin\KonsentrasiController as AdminKonsentrasiController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\Admin\JabatanAkademikController as AdminJabatanController;
use App\Http\Controllers\Admin\HakAksesController as AdminHakAksesController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\WaBlasterController as AdminWaController;
use App\Http\Controllers\Admin\MailBlasterController as AdminMailController;
use App\Http\Controllers\Admin\DownloadController as AdminDownloadController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Admin\PublikasiController as AdminPublikasiController;
use App\Http\Controllers\Admin\RisetUnggulanController as AdminRisetController;
use App\Http\Controllers\Admin\KurikulumController as AdminKurikulumController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\FaqController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/konsentrasi', [HomeController::class, 'konsentrasi'])->name('konsentrasi');
Route::get('/profil-lulusan', [HomeController::class, 'profilLulusan'])->name('profil-lulusan');
Route::get('/akademik', [HomeController::class, 'akademik'])->name('akademik');
Route::get('/dosen', [HomeController::class, 'dosen'])->name('dosen');
Route::get('/dosen/{dosen}', [HomeController::class, 'dosenShow'])->name('dosen.show');
Route::get('/penelitian', [HomeController::class, 'penelitian'])->name('penelitian');
Route::get('/struktur', [HomeController::class, 'struktur'])->name('struktur');
Route::get('/biaya-pendidikan', [HomeController::class, 'biaya'])->name('biaya');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('pengumuman.show');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

Route::get('/download', [DownloadController::class, 'index'])->name('download.index');
Route::get('/download/{download}/unduh', [DownloadController::class, 'unduh'])->name('download.unduh');
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store')->middleware('throttle:5,1');
Route::get('/halaman/{slug}', [HalamanController::class, 'show'])->name('halaman.show');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('berita', AdminBeritaController::class);
    Route::resource('pengumuman', AdminPengumumanController::class);
    Route::resource('galeri', AdminGaleriController::class);
    Route::resource('album', AdminAlbumController::class)->except(['show']);
    Route::post('album/{album}/bulk-upload', [AdminAlbumController::class, 'bulkUpload'])->name('album.bulk-upload');
    Route::post('album/{album}/upload-one', [AdminAlbumController::class, 'uploadOne'])->name('album.upload-one');
    Route::delete('album/{album}/foto/{galeri}', [AdminAlbumController::class, 'destroyFoto'])->name('album.destroy-foto');
    Route::post('album/{album}/cover/{galeri}', [AdminAlbumController::class, 'setCover'])->name('album.set-cover');
    Route::resource('dosen', AdminDosenController::class);
    Route::resource('jabatan', AdminJabatanController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('pejabat', AdminPejabatController::class);
    Route::resource('halaman', AdminHalamanController::class);
    Route::resource('menu', MenuController::class)->except(['show']);
    Route::post('menu/{menu}/up',   [MenuController::class, 'moveUp'])->name('menu.moveUp');
    Route::post('menu/{menu}/down', [MenuController::class, 'moveDown'])->name('menu.moveDown');
    Route::get('pesan', [PesanController::class, 'index'])->name('pesan.index');
    Route::get('pesan/{pesan}', [PesanController::class, 'show'])->name('pesan.show');
    Route::delete('pesan/{pesan}', [PesanController::class, 'destroy'])->name('pesan.destroy');
    Route::resource('jadwal-pmb', JadwalPmbController::class)->except(['show']);
    Route::resource('konsentrasi', AdminKonsentrasiController::class)->except(['show']);
    Route::resource('kurikulum', AdminKurikulumController::class)->except(['show']);
    Route::get('beranda', [AdminBerandaController::class, 'index'])->name('beranda.index');
    Route::post('beranda', [AdminBerandaController::class, 'update'])->name('beranda.update');
    Route::post('beranda/hero-gambar/hapus', [AdminBerandaController::class, 'destroyHeroGambar'])->name('beranda.destroyHeroGambar');
    Route::post('beranda/slider/{num}/hapus', [AdminBerandaController::class, 'destroySliderGambar'])->name('beranda.destroySlider');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    // Hak Akses
    Route::get('hak-akses', [AdminHakAksesController::class, 'index'])->name('hak-akses.index')->middleware('permission:hak_akses');
    Route::post('hak-akses/role', [AdminHakAksesController::class, 'storeRole'])->name('hak-akses.store-role')->middleware('permission:hak_akses');
    Route::put('hak-akses/role/{role}', [AdminHakAksesController::class, 'updateRole'])->name('hak-akses.update-role')->middleware('permission:hak_akses');
    Route::delete('hak-akses/role/{role}', [AdminHakAksesController::class, 'destroyRole'])->name('hak-akses.destroy-role')->middleware('permission:hak_akses');
    Route::post('hak-akses/user', [AdminHakAksesController::class, 'storeUser'])->name('hak-akses.store-user')->middleware('permission:hak_akses');
    Route::put('hak-akses/user/{user}', [AdminHakAksesController::class, 'updateUser'])->name('hak-akses.update-user')->middleware('permission:hak_akses');
    Route::delete('hak-akses/user/{user}', [AdminHakAksesController::class, 'destroyUser'])->name('hak-akses.destroy-user')->middleware('permission:hak_akses');

    // Apply permissions to protected routes
    Route::middleware('permission:galeri')->group(function () {
        // galeri & album routes already defined, permission checked via middleware
    });

    // Profile
    Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('profile/foto', [AdminProfileController::class, 'updateFoto'])->name('profile.foto');
    Route::delete('profile/foto', [AdminProfileController::class, 'destroyFoto'])->name('profile.foto.destroy');

    // Download Center
    Route::get('download', [AdminDownloadController::class, 'index'])->name('download.index');
    Route::post('download', [AdminDownloadController::class, 'store'])->name('download.store');
    Route::put('download/{download}', [AdminDownloadController::class, 'update'])->name('download.update');
    Route::delete('download/{download}', [AdminDownloadController::class, 'destroy'])->name('download.destroy');
    // Download Kategori
    Route::post('download/kategori', [AdminDownloadController::class, 'storeKategori'])->name('download.kategori.store');
    Route::put('download/kategori/{kategori}', [AdminDownloadController::class, 'updateKategori'])->name('download.kategori.update');
    Route::delete('download/kategori/{kategori}', [AdminDownloadController::class, 'destroyKategori'])->name('download.kategori.destroy');

    // FAQ
    Route::get('faq', [AdminFaqController::class, 'index'])->name('faq.index');
    Route::post('faq', [AdminFaqController::class, 'store'])->name('faq.store');
    Route::put('faq/{faq}', [AdminFaqController::class, 'update'])->name('faq.update');
    Route::delete('faq/{faq}', [AdminFaqController::class, 'destroy'])->name('faq.destroy');

    // Testimoni
    Route::get('testimonial', [AdminTestimonialController::class, 'index'])->name('testimonial.index');
    Route::post('testimonial', [AdminTestimonialController::class, 'store'])->name('testimonial.store');
    Route::put('testimonial/{testimonial}', [AdminTestimonialController::class, 'update'])->name('testimonial.update');
    Route::delete('testimonial/{testimonial}', [AdminTestimonialController::class, 'destroy'])->name('testimonial.destroy');

    // Agenda
    Route::get('agenda', [AdminAgendaController::class, 'index'])->name('agenda.index');
    Route::post('agenda', [AdminAgendaController::class, 'store'])->name('agenda.store');
    Route::put('agenda/{agenda}', [AdminAgendaController::class, 'update'])->name('agenda.update');
    Route::delete('agenda/{agenda}', [AdminAgendaController::class, 'destroy'])->name('agenda.destroy');

    // Unggulan Riset
    Route::resource('riset-unggulan', AdminRisetController::class)->except(['show']);

    // Publikasi
    Route::get('publikasi', [AdminPublikasiController::class, 'index'])->name('publikasi.index');
    Route::post('publikasi', [AdminPublikasiController::class, 'store'])->name('publikasi.store');
    Route::put('publikasi/{publikasi}', [AdminPublikasiController::class, 'update'])->name('publikasi.update');
    Route::delete('publikasi/{publikasi}', [AdminPublikasiController::class, 'destroy'])->name('publikasi.destroy');

    // Activity Log
    Route::get('activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');

    // Export CSV
    Route::get('export/pesan', function () {
        $rows = \App\Models\PesanKontak::orderByDesc('created_at')->get();
        $csv  = "Nama,Email,Telepon,Subjek,Pesan,Tanggal\n";
        foreach ($rows as $r) {
            $csv .= implode(',', array_map(fn($v) => '"' . str_replace('"', '""', $v) . '"',
                [$r->nama, $r->email, $r->telepon ?? '', $r->subjek ?? '', $r->pesan, $r->created_at->format('Y-m-d H:i')])) . "\n";
        }
        return response($csv, 200, ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="pesan-masuk.csv"']);
    })->name('export.pesan');

    Route::get('export/dosen', function () {
        $rows = \App\Models\Dosen::orderBy('urutan')->get();
        $csv  = "Nama,NIDN,Jabatan,Konsentrasi,Email\n";
        foreach ($rows as $r) {
            $csv .= implode(',', array_map(fn($v) => '"' . str_replace('"', '""', $v ?? '') . '"',
                [$r->nama, $r->nidn ?? '', $r->jabatan ?? '', $r->konsentrasi ?? '', $r->email ?? ''])) . "\n";
        }
        return response($csv, 200, ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="dosen.csv"']);
    })->name('export.dosen');

    // WA Blaster
    Route::get('wa-blaster', [AdminWaController::class, 'index'])->name('wa.index');
    Route::post('wa-blaster/send', [AdminWaController::class, 'send'])->name('wa.send');

    // Mail Blaster
    Route::get('mail-blaster', [AdminMailController::class, 'index'])->name('mail.index');
    Route::post('mail-blaster/send', [AdminMailController::class, 'send'])->name('mail.send');
    Route::get('sambutan', [SambutanController::class, 'index'])->name('sambutan.index');
    Route::post('sambutan', [SambutanController::class, 'update'])->name('sambutan.update');
    Route::delete('sambutan/foto', [SambutanController::class, 'destroyFoto'])->name('sambutan.destroyFoto');
});

// Sitemap
Route::get('/sitemap.xml', function () {
    $urls = collect([
        ['loc' => url('/'),                   'priority' => '1.0',  'freq' => 'weekly'],
        ['loc' => url('/berita'),             'priority' => '0.9',  'freq' => 'daily'],
        ['loc' => url('/pengumuman'),         'priority' => '0.8',  'freq' => 'weekly'],
        ['loc' => url('/galeri'),             'priority' => '0.7',  'freq' => 'monthly'],
        ['loc' => url('/dosen'),              'priority' => '0.7',  'freq' => 'monthly'],
        ['loc' => url('/download'),           'priority' => '0.6',  'freq' => 'weekly'],
        ['loc' => url('/agenda'),             'priority' => '0.7',  'freq' => 'weekly'],
        ['loc' => url('/faq'),                'priority' => '0.5',  'freq' => 'monthly'],
        ['loc' => url('/penelitian'),         'priority' => '0.6',  'freq' => 'monthly'],
        ['loc' => url('/kontak'),             'priority' => '0.5',  'freq' => 'yearly'],
    ]);

    $berita = \App\Models\Berita::where('is_published', true)->orderByDesc('published_at')->limit(200)->get();
    foreach ($berita as $b) {
        $urls->push(['loc' => route('berita.show', $b->slug), 'priority' => '0.8', 'freq' => 'monthly', 'lastmod' => $b->updated_at->toDateString()]);
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    foreach ($urls as $u) {
        $xml .= "  <url>\n    <loc>{$u['loc']}</loc>\n";
        if (!empty($u['lastmod'])) $xml .= "    <lastmod>{$u['lastmod']}</lastmod>\n";
        $xml .= "    <changefreq>{$u['freq']}</changefreq>\n    <priority>{$u['priority']}</priority>\n  </url>\n";
    }
    $xml .= '</urlset>';
    return response($xml, 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');

// Auth Routes
Route::get('/login', function () {
    $a = rand(1, 9); $b = rand(1, 9);
    session(['captcha_answer' => $a + $b]);
    return view('auth.login', compact('a', 'b'));
})->name('login')->middleware('guest');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
        'captcha'  => 'required|integer',
    ]);

    if ((int) $request->captcha !== (int) session('captcha_answer')) {
        return back()->withErrors(['captcha' => 'Jawaban verifikasi salah.'])->onlyInput('email');
    }

    $credentials = $request->only('email', 'password');
    if (\Illuminate\Support\Facades\Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }
    return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
})->name('login.post')->middleware(['guest', 'throttle:5,1']);

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
