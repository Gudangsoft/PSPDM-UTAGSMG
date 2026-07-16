<?php

namespace App\Http\Controllers;

use App\Models\GaleriVideo;
use Illuminate\Http\Request;

class GaleriVideoController extends Controller
{
    public function index(Request $request)
    {
        $query = GaleriVideo::aktif();

        if ($request->filled('platform')) {
            $query->where('platform', $request->platform);
        }

        $videos = $query->paginate(12);

        return view('galeri-video', compact('videos'));
    }
}
