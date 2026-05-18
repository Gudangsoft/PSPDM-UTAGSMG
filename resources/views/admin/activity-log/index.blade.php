@extends('layouts.admin')
@section('title', 'Log Aktivitas')
@section('page-title', 'Log Aktivitas')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1" style="font-weight:700;">Log Aktivitas Sistem</h5>
        <small class="text-muted">Total: {{ $logs->total() }} entri</small>
    </div>
    <span class="badge rounded-pill px-3 py-2" style="background:#f0f4ff; color:#4f46e5; font-size:.82rem; font-weight:600;">
        <i class="bi bi-shield-lock me-1"></i>Read-Only
    </span>
</div>

{{-- Info Note --}}
<div class="alert border-0 rounded-3 mb-4 d-flex align-items-center gap-2"
     style="background:#eff6ff; color:#1e40af; font-size:.875rem;">
    <i class="bi bi-info-circle-fill flex-shrink-0"></i>
    <span>Log aktivitas dicatat otomatis oleh sistem. Data ini tidak dapat diubah atau dihapus.</span>
</div>

{{-- Filter Row --}}
<div class="admin-card card mb-4">
    <div class="card-body py-3 px-4">
        <form action="{{ route('admin.activity-log.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-auto">
                <label class="form-label mb-1" style="font-size:.8rem; font-weight:600; color:#555;">Modul</label>
                <select name="modul" class="form-select form-select-sm" style="min-width:140px;">
                    <option value="">Semua Modul</option>
                    @foreach($moduls as $modul)
                    <option value="{{ $modul }}" {{ request('modul') === $modul ? 'selected' : '' }}>
                        {{ ucfirst($modul) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <label class="form-label mb-1" style="font-size:.8rem; font-weight:600; color:#555;">Pengguna</label>
                <select name="user_id" class="form-select form-select-sm" style="min-width:160px;">
                    <option value="">Semua Pengguna</option>
                    @foreach($pengguna as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-admin-primary">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
                @if(request('modul') || request('user_id'))
                <a href="{{ route('admin.activity-log.index') }}" class="btn btn-sm btn-outline-secondary ms-1 rounded-2">
                    <i class="bi bi-x-lg me-1"></i>Reset
                </a>
                @endif
            </div>
            @if(request('modul') || request('user_id'))
            <div class="col-auto ms-auto d-flex align-items-end">
                <small class="text-muted">
                    Filter aktif:
                    @if(request('modul'))<span class="badge" style="background:#e0e7ff;color:#3730a3;margin-left:4px;">{{ ucfirst(request('modul')) }}</span>@endif
                    @if(request('user_id'))<span class="badge" style="background:#fdf4ff;color:#7e22ce;margin-left:4px;">{{ optional($pengguna->firstWhere('id', request('user_id')))->name }}</span>@endif
                </small>
            </div>
            @endif
        </form>
    </div>
</div>

{{-- Log Table --}}
<div class="admin-card card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th style="width:140px;">Waktu</th>
                        <th style="width:160px;">Pengguna</th>
                        <th style="width:120px;">Modul</th>
                        <th style="width:130px;">Aksi</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    @php
                        $modulColors = [
                            'download'    => '#0891b2',
                            'faq'         => '#7c3aed',
                            'testimonial' => '#16a34a',
                            'agenda'      => '#d97706',
                            'publikasi'   => '#4f46e5',
                        ];
                        $modulColor = $modulColors[$log->modul] ?? '#666';
                    @endphp
                    <tr>
                        <td>
                            <div style="font-size:.82rem; font-weight:600; color:#333;">
                                {{ $log->created_at->diffForHumans() }}
                            </div>
                            <small class="text-muted" style="font-size:.72rem;">
                                {{ $log->created_at->format('d M Y, H:i') }}
                            </small>
                        </td>
                        <td>
                            @if($log->user)
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:700;color:white;flex-shrink:0;">
                                        {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                    </div>
                                    <span style="font-size:.85rem; font-weight:500; color:#333;">{{ $log->user->name }}</span>
                                </div>
                            @else
                                <span class="text-muted" style="font-size:.85rem;">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge rounded-pill px-2 py-1"
                                  style="background:{{ $modulColor }}18; color:{{ $modulColor }}; border:1px solid {{ $modulColor }}33; font-size:.74rem; font-weight:600;">
                                {{ ucfirst($log->modul) }}
                            </span>
                        </td>
                        <td>
                            <span style="font-size:.85rem; color:#444; font-weight:500;">{{ $log->aksi }}</span>
                        </td>
                        <td>
                            <span style="font-size:.85rem; color:#555;">
                                {{ $log->deskripsi ?? '-' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="bi bi-clipboard-x fs-2 d-block mb-2 opacity-40"></i>
                            @if(request('modul') || request('user_id'))
                                Tidak ada log yang cocok dengan filter yang dipilih.
                                <br><a href="{{ route('admin.activity-log.index') }}" class="btn btn-sm btn-outline-secondary mt-2 rounded-2">Reset Filter</a>
                            @else
                                Belum ada log aktivitas tercatat.
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($logs->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">
        {{ $logs->appends(request()->query())->links() }}
    </div>
    @endif
</div>

@endsection
