<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerandaController extends Controller
{
    private array $keys = [
        // Hero
        'hero_badge', 'hero_judul_1', 'hero_judul_hl', 'hero_judul_2', 'hero_deskripsi',
        'hero_btn1_label', 'hero_btn1_url', 'hero_btn2_label', 'hero_btn2_url',
        // Hero card stats
        'hero_stat1_angka', 'hero_stat1_label',
        'hero_stat2_angka', 'hero_stat2_label',
        'hero_stat3_angka', 'hero_stat3_label',
        // Hero card akreditasi & SK
        'hero_akreditasi_nama', 'hero_akreditasi_badan',
        'hero_sk_nomor', 'hero_sk_valid',
        // Hero card PMB
        'hero_pmb_label', 'hero_pmb_btn', 'hero_pmb_url',
        // Section headings
        'kons_section_judul', 'kons_section_desc',
        'unggul_section_judul', 'unggul_section_desc',
        'lulusan_section_judul', 'lulusan_section_desc',
        'berita_section_judul', 'berita_section_desc',
        'galeri_section_judul', 'galeri_section_desc',
        // Stats bar
        'stats_1_icon', 'stats_1_nilai', 'stats_1_desc',
        'stats_2_icon', 'stats_2_nilai', 'stats_2_desc',
        'stats_3_icon', 'stats_3_nilai', 'stats_3_desc',
        'stats_4_icon', 'stats_4_nilai', 'stats_4_desc',
        // Konsentrasi
        'kons_1_icon', 'kons_1_judul', 'kons_1_deskripsi',
        'kons_2_icon', 'kons_2_judul', 'kons_2_deskripsi',
        'kons_3_icon', 'kons_3_judul', 'kons_3_deskripsi',
        // Keunggulan
        'unggul_1_icon', 'unggul_1_judul', 'unggul_1_deskripsi',
        'unggul_2_icon', 'unggul_2_judul', 'unggul_2_deskripsi',
        'unggul_3_icon', 'unggul_3_judul', 'unggul_3_deskripsi',
        'unggul_4_icon', 'unggul_4_judul', 'unggul_4_deskripsi',
        'unggul_5_icon', 'unggul_5_judul', 'unggul_5_deskripsi',
        'unggul_6_icon', 'unggul_6_judul', 'unggul_6_deskripsi',
        // Profil Lulusan
        'lulusan_1_judul', 'lulusan_1_deskripsi',
        'lulusan_2_judul', 'lulusan_2_deskripsi',
        'lulusan_3_judul', 'lulusan_3_deskripsi',
        'lulusan_4_judul', 'lulusan_4_deskripsi',
        'lulusan_5_judul', 'lulusan_5_deskripsi',
        // CTA section
        'cta_section_judul', 'cta_section_teks',
        'cta_section_btn1_label', 'cta_section_btn1_url',
        'cta_section_btn2_label', 'cta_section_btn2_url',
    ];

    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.beranda.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $sliderRules = [];
        for ($i = 1; $i <= 5; $i++) {
            $sliderRules["hero_slider_$i"] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072';
        }

        $request->validate(array_merge([
            'hero_gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], $sliderRules), [
            'hero_slider_1.max' => 'Ukuran gambar slider maksimal 3 MB.',
            'hero_slider_1.image' => 'File harus berupa gambar.',
        ]);

        if ($request->hasFile('hero_gambar')) {
            $old = Setting::get('hero_gambar');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('hero_gambar', $request->file('hero_gambar')->store('beranda', 'public'));
        }

        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("hero_slider_$i")) {
                $old = Setting::get("hero_slider_$i");
                if ($old) Storage::disk('public')->delete($old);
                Setting::set("hero_slider_$i", $request->file("hero_slider_$i")->store('beranda', 'public'));
            }
        }

        foreach ($this->keys as $key) {
            Setting::set($key, $request->input($key, ''));
        }

        return back()->with('success', 'Konten beranda berhasil disimpan dan langsung tampil di website.');
    }

    public function destroyHeroGambar()
    {
        $old = Setting::get('hero_gambar');
        if ($old) Storage::disk('public')->delete($old);
        Setting::set('hero_gambar', '');

        return back()->with('success', 'Gambar hero berhasil dihapus.');
    }

    public function destroySliderGambar(int $num)
    {
        if ($num < 1 || $num > 5) abort(404);
        $old = Setting::get("hero_slider_$num");
        if ($old) Storage::disk('public')->delete($old);
        Setting::set("hero_slider_$num", '');

        return back()->with('success', "Gambar slider $num berhasil dihapus.");
    }
}
