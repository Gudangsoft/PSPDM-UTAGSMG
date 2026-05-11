<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalPmb;
use Illuminate\Http\Request;

class JadwalPmbController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPmb::orderBy('urutan')->orderBy('id')->get();
        return view('admin.jadwal-pmb.index', compact('jadwals'));
    }

    public function create()
    {
        return view('admin.jadwal-pmb.form', ['jadwal' => new JadwalPmb]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kegiatan'  => 'required|string|max:200',
            'periode'   => 'required|string|max:100',
            'status'    => 'required|in:buka,proses,belum,akan_datang,selesai',
            'urutan'    => 'required|integer|min:0|max:255',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        JadwalPmb::create($data);

        return redirect()->route('admin.jadwal-pmb.index')
            ->with('success', 'Jadwal PMB berhasil ditambahkan.');
    }

    public function edit(JadwalPmb $jadwalPmb)
    {
        return view('admin.jadwal-pmb.form', ['jadwal' => $jadwalPmb]);
    }

    public function update(Request $request, JadwalPmb $jadwalPmb)
    {
        $data = $request->validate([
            'kegiatan'  => 'required|string|max:200',
            'periode'   => 'required|string|max:100',
            'status'    => 'required|in:buka,proses,belum,akan_datang,selesai',
            'urutan'    => 'required|integer|min:0|max:255',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');
        $jadwalPmb->update($data);

        return redirect()->route('admin.jadwal-pmb.index')
            ->with('success', 'Jadwal PMB berhasil diperbarui.');
    }

    public function destroy(JadwalPmb $jadwalPmb)
    {
        $jadwalPmb->delete();
        return redirect()->route('admin.jadwal-pmb.index')
            ->with('success', 'Jadwal PMB berhasil dihapus.');
    }
}
