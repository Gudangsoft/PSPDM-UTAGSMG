@extends('layouts.app')
@section('title', 'Jadwal Akademik - ' . ($site['singkatan']?->value ?? 'PSMPD'))

@section('styles')
<style>
.jadwal-section { padding: 80px 0; background: #f8f9fa; }
.jadwal-header-card {
    background: linear-gradient(135deg, #C0304A 0%, #8B1A2E 60%, #5C0E1C 100%);
    border-radius: 20px; padding: 40px 48px;
    color: white; margin-bottom: 48px;
    position: relative; overflow: hidden;
}
.jadwal-header-card::after {
    content: ''; position: absolute;
    top: -60px; right: -60px;
    width: 250px; height: 250px;
    border-radius: 50%;
    background: rgba(255,255,255,0.05);
    pointer-events: none;
}
.jadwal-header-card h2 {
    font-size: 1.7rem; font-weight: 800;
    margin: 0 0 8px; letter-spacing: .5px;
}
.jadwal-header-card p { margin: 0; opacity: .85; font-size: .95rem; }
.jadwal-semester-pills {
    display: flex; gap: 12px; flex-wrap: wrap; margin-top: 20px;
}
.jadwal-pill {
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 30px; padding: 6px 18px;
    font-size: .82rem; font-weight: 600;
    color: white;
}
.jadwal-table-wrap {
    background: white; border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.07);
    overflow: hidden; margin-bottom: 32px;
}
.jadwal-semester-head {
    background: linear-gradient(135deg, #8B1A2E 0%, #C0304A 100%);
    padding: 16px 28px; color: white;
    display: flex; justify-content: space-between; align-items: center;
}
.jadwal-semester-head h5 { margin: 0; font-size: 1rem; font-weight: 700; }
.jadwal-semester-head .periode-pill {
    background: rgba(255,255,255,.2);
    border-radius: 20px; padding: 3px 14px;
    font-size: .78rem; font-weight: 600;
}
.jadwal-table { width: 100%; border-collapse: collapse; }
.jadwal-table thead th {
    background: #f8f9fa; padding: 11px 18px;
    font-size: .75rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .5px;
    color: #777; border-bottom: 2px solid #eee;
}
.jadwal-table tbody td {
    padding: 13px 18px; border-bottom: 1px solid #f0f0f0;
    font-size: .9rem; color: #444; vertical-align: middle;
}
.jadwal-table tbody tr:last-child td { border-bottom: none; }
.jadwal-table tbody tr:hover td { background: #fafafa; }
.no-badge {
    display: inline-flex; align-items: center; justify-content: center;
    width: 28px; height: 28px; border-radius: 50%;
    background: #fff5f5; color: var(--red-primary);
    border: 1px solid rgba(192,48,74,0.2);
    font-size: .8rem; font-weight: 700;
}
.jenis-badge { padding: 3px 12px; border-radius: 20px; font-size: .75rem; font-weight: 600; }
.jenis-administrasi { background:#eff6ff; color:#1d4ed8; border:1px solid rgba(29,78,216,.2); }
.jenis-perkuliahan  { background:#f0fdf4; color:#15803d; border:1px solid rgba(21,128,61,.2); }
.jenis-evaluasi     { background:#fefce8; color:#b45309; border:1px solid rgba(180,83,9,.2); }
.jenis-sidang       { background:#fff1f2; color:#be123c; border:1px solid rgba(190,18,60,.2); }
.periode-text { font-size:.85rem; color:#555; }
@media(max-width:575.98px){
    .jadwal-header-card { padding:24px 20px; }
    .jadwal-header-card h2 { font-size:1.2rem; }
    .jadwal-semester-head { padding:12px 16px; flex-direction:column; align-items:flex-start; gap:6px; }
    .jadwal-table thead th,.jadwal-table tbody td { padding:9px 10px; font-size:.78rem; }
}
</style>
@endsection

@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1 data-aos="fade-right">Jadwal Akademik</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Jadwal Akademik</li>
            </ol>
        </nav>
    </div>
</div>

<section class="jadwal-section">
    <div class="container-xl">

        {{-- Header Card --}}
        <div class="jadwal-header-card" data-aos="fade-up">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-calendar3-week" style="font-size:2.5rem; opacity:.7; margin-top:4px;"></i>
                <div>
                    <h2>JADWAL AKADEMIK PROGRAM DOKTOR</h2>
                    <p>Program Studi Manajemen &bull; Fakultas Ekonomika dan Bisnis &bull; UNTAG Semarang</p>
                    @php $tahunList = $jadwal->pluck('tahun_akademik')->unique(); @endphp
                    <div class="jadwal-semester-pills">
                        @foreach($tahunList as $th)
                        <span class="jadwal-pill"><i class="bi bi-calendar me-1"></i>Tahun Akademik {{ $th }}</span>
                        @endforeach
                        <span class="jadwal-pill"><i class="bi bi-sun me-1"></i>Semester Gasal: Sept – Feb</span>
                        <span class="jadwal-pill"><i class="bi bi-flower1 me-1"></i>Semester Genap: Maret – Agust</span>
                    </div>
                </div>
            </div>
        </div>

        @forelse($grouped as $key => $rows)
        @php
            [$tahun, $semester] = explode('|', $key);
            $semLabel   = $semester === 'gasal' ? 'Semester Gasal' : 'Semester Genap';
            $semPeriode = $semester === 'gasal' ? 'Sept. ' . substr($tahun,0,4) . ' – Feb. ' . (substr($tahun,5,4)) : 'Maret – Agust. ' . substr($tahun,5,4);
        @endphp
        <div class="jadwal-table-wrap" data-aos="fade-up">
            <div class="jadwal-semester-head">
                <h5><i class="bi bi-calendar3 me-2"></i>{{ strtoupper($semLabel) }} {{ $tahun }}</h5>
                <span class="periode-pill">{{ $semPeriode }}</span>
            </div>
            <div class="table-responsive">
                <table class="jadwal-table">
                    <thead>
                        <tr>
                            <th style="width:52px" class="text-center">No</th>
                            <th style="width:220px">Periode</th>
                            <th>Kegiatan Akademik</th>
                            <th style="width:130px" class="text-center">Jenis Kegiatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $j)
                        <tr>
                            <td class="text-center">
                                <span class="no-badge">{{ $j->no_urut }}</span>
                            </td>
                            <td><span class="periode-text">{{ $j->periode }}</span></td>
                            <td style="font-weight:600; color:#1a1a2e;">{{ $j->kegiatan }}</td>
                            <td class="text-center">
                                <span class="jenis-badge jenis-{{ $j->jenis }}">
                                    {{ ucfirst($j->jenis) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @empty
        <div class="text-center py-5 text-muted">
            <i class="bi bi-calendar-x display-3 d-block mb-3 opacity-25"></i>
            <p>Jadwal akademik belum tersedia.</p>
        </div>
        @endforelse

    </div>
</section>
@endsection
