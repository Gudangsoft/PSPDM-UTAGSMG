<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('urutan')->orderBy('id')->paginate(20);
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:150',
            'isi'   => 'required|string',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'=> 'nullable|integer',
        ]);

        $data = $request->only(['nama', 'jabatan_saat_ini', 'angkatan', 'isi', 'urutan']);
        $data['is_active'] = $request->boolean('is_active', true);
        $data['urutan']    = $request->urutan ?? 0;

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('testimonials', 'public');
        }

        Testimonial::create($data);
        ActivityLog::catat('tambah', 'testimonial', 'Tambah testimoni: ' . $data['nama']);
        return back()->with('success', 'Testimoni berhasil ditambahkan.');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'nama'  => 'required|string|max:150',
            'isi'   => 'required|string',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['nama', 'jabatan_saat_ini', 'angkatan', 'isi', 'urutan']);
        $data['is_active'] = $request->boolean('is_active');
        $data['urutan']    = $request->urutan ?? 0;

        if ($request->hasFile('foto')) {
            if ($testimonial->foto) Storage::disk('public')->delete($testimonial->foto);
            $data['foto'] = $request->file('foto')->store('testimonials', 'public');
        }

        $testimonial->update($data);
        ActivityLog::catat('edit', 'testimonial', 'Edit testimoni: ' . $testimonial->nama);
        return back()->with('success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->foto) Storage::disk('public')->delete($testimonial->foto);
        ActivityLog::catat('hapus', 'testimonial', 'Hapus testimoni: ' . $testimonial->nama);
        $testimonial->delete();
        return back()->with('success', 'Testimoni berhasil dihapus.');
    }
}
