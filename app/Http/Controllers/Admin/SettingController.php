<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_prodi'      => 'required|string|max:200',
            'singkatan'       => 'required|string|max:20',
            'alamat'          => 'required|string',
            'telepon'         => 'required|string|max:30',
            'email'           => 'required|email|max:100',
            'visi'            => 'required|string',
            'misi'            => 'required|string',
            'logo'            => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'favicon'         => 'nullable|image|mimes:png,jpg,jpeg,ico,svg|max:512',
            'tentang_gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'cta_label'       => 'nullable|string|max:60',
            'cta_url'         => 'nullable|string|max:500',
            'maps_embed'          => 'nullable|string|max:2000',
            'website'             => 'nullable|url|max:200',
            'wa_api_key'          => 'nullable|string|max:200',
            'wa_sender'           => 'nullable|string|max:20',
            'nama_fakultas'       => 'nullable|string|max:200',
            'nama_universitas'    => 'nullable|string|max:200',
            'singkatan_institusi' => 'nullable|string|max:100',
            'jam_layanan'         => 'nullable|string|max:500',
            'meta_keywords'       => 'nullable|string|max:500',
            'warna_primer'        => 'nullable|string|max:7',
            'warna_sekunder'      => 'nullable|string|max:7',
            'warna_gelap'         => 'nullable|string|max:7',
        ]);

        $textKeys = [
            'nama_prodi', 'singkatan', 'alamat', 'telepon', 'email', 'website',
            'wa_api_key', 'wa_sender',
            'visi', 'misi', 'facebook', 'instagram', 'youtube', 'twitter',
            'whatsapp', 'deskripsi_singkat', 'cta_label', 'cta_url',
            'info_akreditasi', 'info_durasi', 'info_sks', 'maps_embed',
            'nama_fakultas', 'nama_universitas', 'singkatan_institusi',
            'jam_layanan', 'meta_keywords',
            'warna_primer', 'warna_sekunder', 'warna_gelap',
        ];

        Setting::set('cta_aktif', $request->has('cta_aktif') ? '1' : '0');

        foreach ($textKeys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $old = Setting::get('logo');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('logo', $request->file('logo')->store('settings', 'public'));
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $old = Setting::get('favicon');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('favicon', $request->file('favicon')->store('settings', 'public'));
        }

        // Handle tentang_gambar upload
        if ($request->hasFile('tentang_gambar')) {
            $old = Setting::get('tentang_gambar');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('tentang_gambar', $request->file('tentang_gambar')->store('settings', 'public'));
        }

        return back()->with('success', 'Pengaturan website berhasil disimpan dan telah tersinkronisasi ke seluruh halaman.');
    }
}
