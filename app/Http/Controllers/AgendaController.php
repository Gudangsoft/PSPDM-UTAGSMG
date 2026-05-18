<?php

namespace App\Http\Controllers;

use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
        $mendatang = Agenda::aktif()->mendatang()->terurut()->get();
        $lewat     = Agenda::aktif()->where('tanggal_mulai', '<', now()->toDateString())->orderByDesc('tanggal_mulai')->limit(10)->get();
        return view('agenda', compact('mendatang', 'lewat'));
    }
}
