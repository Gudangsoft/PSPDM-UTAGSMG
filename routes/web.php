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

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/konsentrasi', [HomeController::class, 'konsentrasi'])->name('konsentrasi');
Route::get('/profil-lulusan', [HomeController::class, 'profilLulusan'])->name('profil-lulusan');
Route::get('/akademik', [HomeController::class, 'akademik'])->name('akademik');
Route::get('/dosen', [HomeController::class, 'dosen'])->name('dosen');
Route::get('/penelitian', [HomeController::class, 'penelitian'])->name('penelitian');
Route::get('/struktur', [HomeController::class, 'struktur'])->name('struktur');
Route::get('/biaya-pendidikan', [HomeController::class, 'biaya'])->name('biaya');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{pengumuman}', [PengumumanController::class, 'show'])->name('pengumuman.show');

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store')->middleware('throttle:5,1');
Route::get('/halaman/{slug}', [HalamanController::class, 'show'])->name('halaman.show');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('berita', AdminBeritaController::class);
    Route::resource('pengumuman', AdminPengumumanController::class);
    Route::resource('galeri', AdminGaleriController::class);
    Route::resource('dosen', AdminDosenController::class);
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
    Route::get('beranda', [AdminBerandaController::class, 'index'])->name('beranda.index');
    Route::post('beranda', [AdminBerandaController::class, 'update'])->name('beranda.update');
    Route::post('beranda/hero-gambar/hapus', [AdminBerandaController::class, 'destroyHeroGambar'])->name('beranda.destroyHeroGambar');
    Route::post('beranda/slider/{num}/hapus', [AdminBerandaController::class, 'destroySliderGambar'])->name('beranda.destroySlider');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('sambutan', [SambutanController::class, 'index'])->name('sambutan.index');
    Route::post('sambutan', [SambutanController::class, 'update'])->name('sambutan.update');
    Route::delete('sambutan/foto', [SambutanController::class, 'destroyFoto'])->name('sambutan.destroyFoto');
});

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);
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
