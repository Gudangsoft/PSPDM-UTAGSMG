<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalAkademik;
use Illuminate\Http\Request;

class JadwalAkademikController extends Controller
{
    public function index()
    {
        $jadwal = JadwalAkademik::orderBy('tahun_akademik')
            ->orderByRaw("FIELD(semester,'gasal','genap')")
            ->orderBy('no_urut')
            ->get();

        $grouped = $jadwal->groupBy(fn($j) => $j->tahun_akademik . '|' . $j->semester);

        return view('admin.jadwal-akademik.index', compact('jadwal', 'grouped'));
    }

    public function create()
    {
        return view('admin.jadwal-akademik.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tahun_akademik' => 'required|string|max:20',
            'semester'       => 'required|in:gasal,genap',
            'no_urut'        => 'required|integer|min:1|max:99',
            'periode'        => 'required|string|max:100',
            'kegiatan'       => 'required|string|max:200',
            'jenis'          => 'required|in:administrasi,perkuliahan,evaluasi,sidang',
            'is_active'      => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        JadwalAkademik::create($data);

        return redirect()->route('admin.jadwal-akademik.index')
            ->with('success', 'Jadwal akademik berhasil ditambahkan.');
    }

    public function edit(JadwalAkademik $jadwalAkademik)
    {
        return view('admin.jadwal-akademik.edit', compact('jadwalAkademik'));
    }

    public function update(Request $request, JadwalAkademik $jadwalAkademik)
    {
        $data = $request->validate([
            'tahun_akademik' => 'required|string|max:20',
            'semester'       => 'required|in:gasal,genap',
            'no_urut'        => 'required|integer|min:1|max:99',
            'periode'        => 'required|string|max:100',
            'kegiatan'       => 'required|string|max:200',
            'jenis'          => 'required|in:administrasi,perkuliahan,evaluasi,sidang',
            'is_active'      => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $jadwalAkademik->update($data);

        return redirect()->route('admin.jadwal-akademik.index')
            ->with('success', 'Jadwal akademik berhasil diperbarui.');
    }

    public function destroy(JadwalAkademik $jadwalAkademik)
    {
        $jadwalAkademik->delete();
        return back()->with('success', 'Jadwal akademik berhasil dihapus.');
    }
}
