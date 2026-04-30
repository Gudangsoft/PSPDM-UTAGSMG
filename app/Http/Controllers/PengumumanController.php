<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::aktif()->latest()->paginate(10);
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('pengumuman.show', compact('pengumuman'));
    }
}
