@extends('layouts.app')
@section('title', 'Akademik - ' . ($site['singkatan']?->value ?? 'PSMPD') . '-FEB UNTAG Semarang')

@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-book me-2"></i>Akademik</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Akademik</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <ul class="nav nav-pills mb-5 justify-content-center" id="akademikTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-4 py-2" id="kurikulum-tab" data-bs-toggle="pill" data-bs-target="#kurikulum" type="button">
                    <i class="bi bi-list-check me-2"></i>Kurikulum
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-2" id="syarat-tab" data-bs-toggle="pill" data-bs-target="#syarat" type="button">
                    <i class="bi bi-clipboard-check me-2"></i>Syarat Pendaftaran
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-2" id="jadwal-tab" data-bs-toggle="pill" data-bs-target="#jadwal" type="button">
                    <i class="bi bi-calendar3 me-2"></i>Jadwal PMB
                </button>
            </li>
        </ul>

        <div class="tab-content" id="akademikTabContent">
            <div class="tab-pane fade show active" id="kurikulum">
                {!! $halamanMap['akademik-kurikulum']?->konten ?? '' !!}
            </div>
            <div class="tab-pane fade" id="syarat">
                {!! $halamanMap['akademik-syarat-pendaftaran']?->konten ?? '' !!}
            </div>
            <div class="tab-pane fade" id="jadwal">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header" style="background:linear-gradient(135deg,var(--red-primary),var(--red-dark));color:white;border-radius:16px 16px 0 0;padding:20px;">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-calendar-event me-2"></i>Jadwal Penerimaan Mahasiswa Baru {{ date('Y') }}/{{ date('Y') + 1 }}</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead style="background:#f8f8f8;">
                                <tr>
                                    <th style="padding:16px 20px;">Kegiatan</th>
                                    <th style="padding:16px 20px;">Periode</th>
                                    <th style="padding:16px 20px;">Status</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:0.875rem;">
                                @forelse($jadwals as $jadwal)
                                <tr>
                                    <td style="padding:14px 20px;"><strong>{{ $jadwal->kegiatan }}</strong></td>
                                    <td style="padding:14px 20px;">{{ $jadwal->periode }}</td>
                                    <td style="padding:14px 20px;">
                                        <span class="badge rounded-pill {{ $jadwal->status_class }}">{{ $jadwal->status_label }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center text-muted py-4">Jadwal PMB belum tersedia.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('kontak') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-pencil-square me-2"></i>Hubungi untuk Informasi Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.nav-pills .nav-link { color: var(--dark); border-radius: 50px; margin: 0 4px; }
.nav-pills .nav-link.active { background: var(--red-primary); }
</style>

@endsection
