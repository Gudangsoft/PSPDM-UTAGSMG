<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SambutanController extends Controller
{
    public function index()
    {
        return view('admin.sambutan.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'sambutan_nama'    => 'required|string|max:150',
            'sambutan_jabatan' => 'required|string|max:150',
            'sambutan_isi'     => 'required|string',
            'sambutan_foto'    => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'sambutan_chip'    => 'nullable|string|max:100',
            'sambutan_judul'   => 'nullable|string|max:150',
        ]);

        Setting::set('sambutan_nama',    $request->input('sambutan_nama'));
        Setting::set('sambutan_jabatan', $request->input('sambutan_jabatan'));
        Setting::set('sambutan_isi',     $request->input('sambutan_isi'));
        Setting::set('sambutan_chip',    $request->input('sambutan_chip',  'Sambutan Ketua Program Studi'));
        Setting::set('sambutan_judul',   $request->input('sambutan_judul', 'Selamat Datang di'));

        if ($request->hasFile('sambutan_foto')) {
            $old = Setting::get('sambutan_foto');
            if ($old) Storage::disk('public')->delete($old);
            Setting::set('sambutan_foto', $request->file('sambutan_foto')->store('sambutan', 'public'));
        }

        return back()->with('success', 'Sambutan Ketua Program Studi berhasil diperbarui.');
    }

    public function destroyFoto()
    {
        $old = Setting::get('sambutan_foto');
        if ($old) Storage::disk('public')->delete($old);
        Setting::set('sambutan_foto', '');

        return back()->with('success', 'Foto sambutan berhasil dihapus.');
    }
}
