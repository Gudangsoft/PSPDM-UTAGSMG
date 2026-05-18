<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('tanggal_mulai', 'desc')->paginate(20);
        return view('admin.agenda.index', compact('agendas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'          => 'required|string|max:200',
            'tanggal_mulai'  => 'required|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $agenda = Agenda::create([
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'tanggal_mulai'  => $request->tanggal_mulai,
            'tanggal_selesai'=> $request->tanggal_selesai,
            'waktu'          => $request->waktu,
            'lokasi'         => $request->lokasi,
            'is_active'      => $request->boolean('is_active', true),
        ]);

        ActivityLog::catat('tambah', 'agenda', 'Tambah agenda: ' . $agenda->judul);
        return back()->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function update(Request $request, Agenda $agenda)
    {
        $request->validate([
            'judul'         => 'required|string|max:200',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $agenda->update([
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'tanggal_mulai'  => $request->tanggal_mulai,
            'tanggal_selesai'=> $request->tanggal_selesai,
            'waktu'          => $request->waktu,
            'lokasi'         => $request->lokasi,
            'is_active'      => $request->boolean('is_active'),
        ]);

        ActivityLog::catat('edit', 'agenda', 'Edit agenda: ' . $agenda->judul);
        return back()->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        ActivityLog::catat('hapus', 'agenda', 'Hapus agenda: ' . $agenda->judul);
        $agenda->delete();
        return back()->with('success', 'Agenda berhasil dihapus.');
    }
}
