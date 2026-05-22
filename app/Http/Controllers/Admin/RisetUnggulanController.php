<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RisetUnggulan;
use Illuminate\Http\Request;

class RisetUnggulanController extends Controller
{
    public function index()
    {
        try {
            $items = RisetUnggulan::orderBy('urutan')->get();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tabel belum ada. Jalankan: php artisan migrate');
        }
        return view('admin.riset-unggulan.index', compact('items'));
    }

    public function create()
    {
        return view('admin.riset-unggulan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'icon'      => 'required|string|max:80',
            'warna'     => 'required|string|max:20',
            'urutan'    => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        RisetUnggulan::create($validated);

        return redirect()->route('admin.riset-unggulan.index')
                         ->with('success', 'Unggulan riset berhasil ditambahkan.');
    }

    public function edit(RisetUnggulan $risetUnggulan)
    {
        return view('admin.riset-unggulan.edit', ['item' => $risetUnggulan]);
    }

    public function update(Request $request, RisetUnggulan $risetUnggulan)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'icon'      => 'required|string|max:80',
            'warna'     => 'required|string|max:20',
            'urutan'    => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $risetUnggulan->update($validated);

        return redirect()->route('admin.riset-unggulan.index')
                         ->with('success', 'Unggulan riset berhasil diperbarui.');
    }

    public function destroy(RisetUnggulan $risetUnggulan)
    {
        $risetUnggulan->delete();

        return back()->with('success', 'Unggulan riset berhasil dihapus.');
    }
}
