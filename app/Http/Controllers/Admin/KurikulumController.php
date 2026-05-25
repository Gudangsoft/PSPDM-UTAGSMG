<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index()
    {
        $kurikulum = Kurikulum::orderBy('semester')->orderBy('urutan')->get();
        return view('admin.kurikulum.index', compact('kurikulum'));
    }

    public function create()
    {
        return view('admin.kurikulum.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_mk'    => 'nullable|string|max:20',
            'nama_mk'    => 'required|string|max:200',
            'sks'        => 'required|integer|min:1|max:6',
            'semester'   => 'required|integer|min:1|max:8',
            'jenis'      => 'required|in:wajib,pilihan',
            'keterangan' => 'nullable|string',
            'urutan'     => 'required|integer|min:0',
            'is_active'  => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        Kurikulum::create($data);

        return redirect()->route('admin.kurikulum.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(Kurikulum $kurikulum)
    {
        return view('admin.kurikulum.edit', compact('kurikulum'));
    }

    public function update(Request $request, Kurikulum $kurikulum)
    {
        $data = $request->validate([
            'kode_mk'    => 'nullable|string|max:20',
            'nama_mk'    => 'required|string|max:200',
            'sks'        => 'required|integer|min:1|max:6',
            'semester'   => 'required|integer|min:1|max:8',
            'jenis'      => 'required|in:wajib,pilihan',
            'keterangan' => 'nullable|string',
            'urutan'     => 'required|integer|min:0',
            'is_active'  => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        $kurikulum->update($data);

        return redirect()->route('admin.kurikulum.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Kurikulum $kurikulum)
    {
        $kurikulum->delete();
        return back()->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
