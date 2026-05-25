@extends('layouts.admin')
@section('title', 'Jadwal Akademik')
@section('page-title', 'Jadwal Akademik Program Doktor')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:.875rem;">Kelola jadwal kegiatan akademik per tahun akademik dan semester.</p>
    <a href="{{ route('admin.jadwal-akademik.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Jadwal
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@php
    $jenisBadge = [
        'administrasi' => 'bg-primary-subtle text-primary border border-primary-subtle',
        'perkuliahan'  => 'bg-success-subtle text-success border border-success-subtle',
        'evaluasi'     => 'bg-warning-subtle text-warning border border-warning-subtle',
        'sidang'       => 'bg-danger-subtle text-danger border border-danger-subtle',
    ];
    $jenisLabel = [
        'administrasi' => 'Administrasi',
        'perkuliahan'  => 'Perkuliahan',
        'evaluasi'     => 'Evaluasi',
        'sidang'       => 'Sidang',
    ];
@endphp

@forelse($grouped as $key => $rows)
    @php
        [$tahun, $semester] = explode('|', $key);
        $semLabel = $semester === 'gasal' ? 'Semester Gasal' : 'Semester Genap';
        $semPeriode = $semester === 'gasal' ? 'Sept – Feb' : 'Maret – Agust';
    @endphp
    <div class="admin-card card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <span style="font-weight:700; color:var(--red);">
                    <i class="bi bi-calendar3-week me-2"></i>{{ $semLabel }} {{ $tahun }}
                </span>
                <span class="text-muted ms-2" style="font-size:.8rem;">({{ $semPeriode }})</span>
            </div>
            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                {{ $rows->count() }} kegiatan
            </span>
        </div>
        <div class="card-body p-0">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th style="width:50px" class="text-center">No</th>
                        <th style="width:200px">Periode</th>
                        <th>Kegiatan Akademik</th>
                        <th style="width:120px" class="text-center">Jenis</th>
                        <th style="width:80px" class="text-center">Status</th>
                        <th style="width:110px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $j)
                    <tr>
                        <td class="text-center">
                            <span class="badge bg-secondary rounded-pill">{{ $j->no_urut }}</span>
                        </td>
                        <td style="font-size:.85rem; color:#555;">{{ $j->periode }}</td>
                        <td style="font-weight:600; color:#1a1a2e;">{{ $j->kegiatan }}</td>
                        <td class="text-center">
                            <span class="badge {{ $jenisBadge[$j->jenis] ?? '' }}">
                                {{ $jenisLabel[$j->jenis] ?? $j->jenis }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($j->is_active)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">Aktif</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.jadwal-akademik.edit', $j) }}"
                                   class="btn btn-sm btn-outline-primary rounded-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.jadwal-akademik.destroy', $j) }}" method="POST"
                                      onsubmit="return confirm('Hapus jadwal ini?')">
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
        <i class="bi bi-calendar-x display-5 d-block mb-2 opacity-25"></i>
        Belum ada jadwal akademik. <a href="{{ route('admin.jadwal-akademik.create') }}">Tambah sekarang</a>
    </div>
</div>
@endforelse

@endsection
