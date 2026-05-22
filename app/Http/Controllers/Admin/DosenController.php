<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\JabatanAkademik;
use App\Models\Konsentrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::orderBy('urutan')->paginate(20);
        return view('admin.dosen.index', compact('dosen'));
    }

    public function create()
    {
        $jabatans     = JabatanAkademik::aktif()->get();
        $konsentrasis = Konsentrasi::aktif()->get();
        return view('admin.dosen.create', compact('jabatans', 'konsentrasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:100',
            'nidn'          => 'nullable|string|max:20',
            'jabatan'       => 'required|string|max:100',
            'konsentrasi'   => 'nullable|string|max:100',
            'keahlian'      => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email'         => 'nullable|email|max:100',
            'bio'           => 'nullable|string',
            'google_scholar'    => 'nullable|url|max:255',
            'sinta_url'         => 'nullable|url|max:255',
            'scopus_url'        => 'nullable|url|max:255',
            'researchgate_url'  => 'nullable|url|max:255',
            'urutan'            => 'integer|min:0',
            'is_active'         => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        Dosen::create($validated);

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        $jabatans     = JabatanAkademik::aktif()->get();
        $konsentrasis = Konsentrasi::aktif()->get();
        return view('admin.dosen.edit', compact('dosen', 'jabatans', 'konsentrasis'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:100',
            'slug'          => 'nullable|string|max:120|unique:dosen,slug,' . $dosen->id,
            'nidn'          => 'nullable|string|max:20',
            'jabatan'       => 'required|string|max:100',
            'konsentrasi'   => 'nullable|string|max:100',
            'keahlian'      => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'email'         => 'nullable|email|max:100',
            'bio'           => 'nullable|string',
            'google_scholar'    => 'nullable|url|max:255',
            'sinta_url'         => 'nullable|url|max:255',
            'scopus_url'        => 'nullable|url|max:255',
            'researchgate_url'  => 'nullable|url|max:255',
            'urutan'            => 'integer|min:0',
            'is_active'         => 'boolean',
        ]);

        // Normalize slug: kebab-case, or keep existing if left blank
        if (!empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['slug']);
        } else {
            unset($validated['slug']);
        }

        if ($request->hasFile('foto')) {
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $validated['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        $dosen->update($validated);

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        if ($dosen->foto) {
            Storage::disk('public')->delete($dosen->foto);
        }
        $dosen->delete();

        return back()->with('success', 'Data dosen berhasil dihapus.');
    }
}
