<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'telepon' => 'nullable|string|max:20',
            'subjek'  => 'required|string|max:200',
            'pesan'   => 'required|string|max:2000',
        ], [
            'nama.required'   => 'Nama wajib diisi.',
            'email.required'  => 'Email wajib diisi.',
            'email.email'     => 'Format email tidak valid.',
            'subjek.required' => 'Subjek wajib diisi.',
            'pesan.required'  => 'Pesan wajib diisi.',
        ]);

        PesanKontak::create($validated);

        return back()->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
