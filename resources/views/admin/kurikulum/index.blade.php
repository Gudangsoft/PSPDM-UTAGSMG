@extends('layouts.admin')
@section('title', 'Kurikulum')
@section('page-title', 'Kurikulum Program Studi')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:.875rem;">Kelola daftar mata kuliah dan struktur kurikulum program studi.</p>
    </div>
    <a href="{{ route('admin.kurikulum.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Mata Kuliah
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@php
    $bySemester = $kurikulum->groupBy('semester');
    $totalSks   = $kurikulum->where('is_active', true)->sum('sks');
@endphp

{{-- Summary --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="admin-card card text-center p-3">
            <div style="font-size:1.8rem; font-weight:800; color:var(--red);">{{ $kurikulum->count() }}</div>
            <div class="text-muted" style="font-size:.8rem;">Total Mata Kuliah</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="admin-card card text-center p-3">
            <div style="font-size:1.8rem; font-weight:800; color:var(--red);">{{ $totalSks }}</div>
            <div class="text-muted" style="font-size:.8rem;">Total SKS Aktif</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="admin-card card text-center p-3">
            <div style="font-size:1.8rem; font-weight:800; color:var(--red);">{{ $kurikulum->where('jenis','wajib')->count() }}</div>
            <div class="text-muted" style="font-size:.8rem;">MK Wajib</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="admin-card card text-center p-3">
            <div style="font-size:1.8rem; font-weight:800; color:var(--red);">{{ $kurikulum->where('jenis','pilihan')->count() }}</div>
            <div class="text-muted" style="font-size:.8rem;">MK Pilihan</div>
        </div>
    </div>
</div>

@forelse($bySemester as $semester => $matkuls)
<div class="admin-card card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span style="font-weight:700;">
            <i class="bi bi-calendar3 me-2" style="color:var(--red);"></i>Semester {{ $semester }}
        </span>
        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
            {{ $matkuls->sum('sks') }} SKS
        </span>
    </div>
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:100px">Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th style="width:60px" class="text-center">SKS</th>
                    <th style="width:90px" class="text-center">Jenis</th>
                    <th style="width:80px" class="text-center">Status</th>
                    <th style="width:110px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matkuls->sortBy('urutan') as $mk)
                <tr>
                    <td>
                        <span style="font-size:.82rem; color:#888; font-family:monospace;">{{ $mk->kode_mk ?: '-' }}</span>
                    </td>
                    <td>
                        <div style="font-weight:600; color:#1a1a2e;">{{ $mk->nama_mk }}</div>
                        @if($mk->keterangan)
                            <div style="font-size:.78rem; color:#999;" class="mt-1">{{ Str::limit($mk->keterangan, 80) }}</div>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="badge rounded-pill" style="background:#fff5f5; color:var(--red); border:1px solid rgba(192,48,74,.2);">
                            {{ $mk->sks }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if($mk->jenis === 'wajib')
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Wajib</span>
                        @else
                            <span class="badge bg-info-subtle text-info border border-info-subtle">Pilihan</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($mk->is_active)
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Aktif</span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.kurikulum.edit', $mk) }}"
                               class="btn btn-sm btn-outline-primary rounded-2" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.kurikulum.destroy', $mk) }}" method="POST"
                                  onsubmit="return confirm('Hapus mata kuliah ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-2" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@empty
<div class="admin-card card">
    <div class="card-body text-center text-muted py-5">
        <i class="bi bi-book display-5 d-block mb-2 opacity-25"></i>
        Belum ada data kurikulum. <a href="{{ route('admin.kurikulum.create') }}">Tambah sekarang</a>
    </div>
</div>
@endforelse

@endsection
