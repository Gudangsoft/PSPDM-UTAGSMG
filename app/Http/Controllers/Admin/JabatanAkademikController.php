<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JabatanAkademik;
use Illuminate\Http\Request;

class JabatanAkademikController extends Controller
{
    public function index()
    {
        $jabatans = JabatanAkademik::orderBy('urutan')->get();
        return view('admin.jabatan.index', compact('jabatans'));
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:100|unique:jabatan_akademik,nama']);
        JabatanAkademik::create([
            'nama'      => $request->nama,
            'urutan'    => JabatanAkademik::max('urutan') + 1,
            'is_active' => true,
        ]);
        return back()->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function update(Request $request, JabatanAkademik $jabatan)
    {
        $request->validate([
            'nama'      => 'required|string|max:100|unique:jabatan_akademik,nama,' . $jabatan->id,
            'urutan'    => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $jabatan->update([
            'nama'      => $request->nama,
            'urutan'    => $request->urutan,
            'is_active' => $request->boolean('is_active'),
        ]);
        return back()->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(JabatanAkademik $jabatan)
    {
        $jabatan->delete();
        return back()->with('success', 'Jabatan berhasil dihapus.');
    }
}
