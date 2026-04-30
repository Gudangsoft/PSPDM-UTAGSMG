<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PejabatController extends Controller
{
    public function index()
    {
        $pejabat = Pejabat::orderBy('urutan')->get();
        return view('admin.pejabat.index', compact('pejabat'));
    }

    public function create()
    {
        return view('admin.pejabat.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'       => 'required|string|max:150',
            'jabatan'    => 'required|string|max:150',
            'nidn'       => 'nullable|string|max:20',
            'email'      => 'nullable|email|max:100',
            'telepon'    => 'nullable|string|max:30',
            'keterangan' => 'nullable|string',
            'urutan'     => 'required|integer|min:0',
            'is_active'  => 'boolean',
            'foto'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pejabat', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        Pejabat::create($data);

        return redirect()->route('admin.pejabat.index')->with('success', 'Data pejabat berhasil ditambahkan.');
    }

    public function edit(Pejabat $pejabat)
    {
        return view('admin.pejabat.edit', compact('pejabat'));
    }

    public function update(Request $request, Pejabat $pejabat)
    {
        $data = $request->validate([
            'nama'       => 'required|string|max:150',
            'jabatan'    => 'required|string|max:150',
            'nidn'       => 'nullable|string|max:20',
            'email'      => 'nullable|email|max:100',
            'telepon'    => 'nullable|string|max:30',
            'keterangan' => 'nullable|string',
            'urutan'     => 'required|integer|min:0',
            'is_active'  => 'boolean',
            'foto'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($pejabat->foto) Storage::disk('public')->delete($pejabat->foto);
            $data['foto'] = $request->file('foto')->store('pejabat', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        $pejabat->update($data);

        return redirect()->route('admin.pejabat.index')->with('success', 'Data pejabat berhasil diperbarui.');
    }

    public function destroy(Pejabat $pejabat)
    {
        if ($pejabat->foto) Storage::disk('public')->delete($pejabat->foto);
        $pejabat->delete();

        return back()->with('success', 'Data pejabat berhasil dihapus.');
    }
}
