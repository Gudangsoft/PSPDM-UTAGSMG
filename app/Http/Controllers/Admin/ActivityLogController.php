<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::with('user')
            ->when($request->modul, fn($q) => $q->where('modul', $request->modul))
            ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
            ->orderByDesc('created_at')
            ->paginate(50);

        $moduls   = ActivityLog::select('modul')->distinct()->pluck('modul')->filter()->sort()->values();
        $pengguna = \App\Models\User::orderBy('name')->get(['id', 'name']);

        return view('admin.activity-log.index', compact('logs', 'moduls', 'pengguna'));
    }
}
