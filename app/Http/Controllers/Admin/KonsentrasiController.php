<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konsentrasi;
use Illuminate\Http\Request;

class KonsentrasiController extends Controller
{
    public function index()
    {
        $konsentrasis = Konsentrasi::orderBy('urutan')->get();
        return view('admin.konsentrasi.index', compact('konsentrasis'));
    }

    public function create()
    {
        return view('admin.konsentrasi.form', ['konsentrasi' => new Konsentrasi]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['topik'] = $this->parseTopik($request->input('topik_raw', ''));
        Konsentrasi::create($data);

        return redirect()->route('admin.konsentrasi.index')
            ->with('success', 'Konsentrasi berhasil ditambahkan.');
    }

    public function edit(Konsentrasi $konsentrasi)
    {
        return view('admin.konsentrasi.form', compact('konsentrasi'));
    }

    public function update(Request $request, Konsentrasi $konsentrasi)
    {
        $data = $this->validated($request);
        $data['topik'] = $this->parseTopik($request->input('topik_raw', ''));
        $konsentrasi->update($data);

        return redirect()->route('admin.konsentrasi.index')
            ->with('success', 'Konsentrasi berhasil diperbarui.');
    }

    public function destroy(Konsentrasi $konsentrasi)
    {
        $konsentrasi->delete();
        return redirect()->route('admin.konsentrasi.index')
            ->with('success', 'Konsentrasi berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama'               => 'required|string|max:200',
            'nama_en'            => 'nullable|string|max:200',
            'ikon'               => 'nullable|string|max:60',
            'warna_primer'       => 'nullable|string|max:20',
            'warna_sekunder'     => 'nullable|string|max:20',
            'deskripsi'          => 'required|string',
            'deskripsi_lanjutan' => 'nullable|string',
            'urutan'             => 'required|integer|min:0|max:255',
            'is_active'          => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }

    private function parseTopik(string $raw): array
    {
        return array_values(array_filter(
            array_map('trim', explode("\n", str_replace("\r", '', $raw)))
        ));
    }
}
