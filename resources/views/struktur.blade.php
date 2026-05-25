@extends('layouts.app')
@section('title', 'Struktur Organisasi - ' . ($site['singkatan']?->value ?? 'PSMPD'))

@section('styles')
<style>
/* ===== SAMBUTAN ===== */
.sambutan-section { padding: 80px 0; background: white; }
.sambutan-photo-wrap {
    position: relative; display: inline-block;
}
.sambutan-photo {
    width: 280px; height: 320px; object-fit: cover;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(139,0,0,0.2);
    display: block;
}
.sambutan-photo-placeholder {
    width: 280px; height: 320px; border-radius: 20px;
    background: linear-gradient(135deg, #C0304A 0%, #8B1A2E 55%, #5C0E1C 100%);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    color: white; box-shadow: 0 20px 60px rgba(139,0,0,0.2);
}
.sambutan-photo-placeholder i { font-size: 4rem; opacity: 0.6; }
.sambutan-accent {
    position: absolute; bottom: -16px; right: -16px;
    width: 100px; height: 100px; border-radius: 16px;
    background: linear-gradient(135deg, #C0304A 0%, #8B1A2E 60%, #5C0E1C 100%);
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 2rem;
    box-shadow: 0 8px 25px rgba(192,48,74,0.35);
}
.sambutan-content { padding-left: 20px; }
.sambutan-label {
    display: inline-flex; align-items: center; gap: 8px;
    background: #fff5f5; color: var(--red-primary);
    border: 1px solid rgba(192,48,74,0.15);
    padding: 6px 16px; border-radius: 30px;
    font-size: 0.8rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1px;
    margin-bottom: 16px;
}
.sambutan-quote {
    font-size: 1rem; line-height: 1.85; color: #444;
    border-left: 4px solid var(--red-primary);
    padding-left: 20px; margin: 20px 0;
}
.sambutan-signature { margin-top: 28px; }
.sambutan-signature .sig-name { font-size: 1.1rem; font-weight: 700; color: var(--dark); margin: 0; }
.sambutan-signature .sig-jabatan { font-size: 0.85rem; color: var(--red-primary); font-weight: 600; }
.sambutan-signature .sig-instansi { font-size: 0.8rem; color: #888; }

/* ===== KURIKULUM ===== */
.kurikulum-section { padding: 80px 0; background: white; }
.kurikulum-semester-card {
    background: white; border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    overflow: hidden; margin-bottom: 24px;
}
.kurikulum-semester-header {
    background: linear-gradient(135deg, #C0304A 0%, #8B1A2E 100%);
    color: white; padding: 14px 24px;
    display: flex; justify-content: space-between; align-items: center;
}
.kurikulum-semester-header h5 { margin: 0; font-size: 1rem; font-weight: 700; }
.kurikulum-semester-header .sks-badge {
    background: rgba(255,255,255,0.2);
    padding: 3px 12px; border-radius: 20px;
    font-size: 0.82rem; font-weight: 600;
}
.kurikulum-table { width: 100%; border-collapse: collapse; }
.kurikulum-table th {
    background: #f8f9fa; padding: 10px 16px;
    font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.5px;
    color: #666; border-bottom: 1px solid #eee;
}
.kurikulum-table td {
    padding: 12px 16px; border-bottom: 1px solid #f0f0f0;
    font-size: 0.88rem; color: #444;
}
.kurikulum-table tr:last-child td { border-bottom: none; }
.kurikulum-table tr:hover td { background: #fafafa; }
.mk-kode { font-family: monospace; font-size: 0.82rem; color: #888; }
.mk-nama { font-weight: 600; color: #1a1a2e; }
.mk-sks {
    display: inline-block;
    background: #fff5f5; color: var(--red-primary);
    border: 1px solid rgba(192,48,74,0.2);
    padding: 2px 10px; border-radius: 20px;
    font-size: 0.78rem; font-weight: 700;
}
.mk-jenis-wajib {
    display: inline-block;
    background: #eff6ff; color: #1d4ed8;
    border: 1px solid rgba(29,78,216,0.2);
    padding: 2px 10px; border-radius: 20px;
    font-size: 0.75rem; font-weight: 600;
}
.mk-jenis-pilihan {
    display: inline-block;
    background: #f0fdfa; color: #0d9488;
    border: 1px solid rgba(13,148,136,0.2);
    padding: 2px 10px; border-radius: 20px;
    font-size: 0.75rem; font-weight: 600;
}
.kurikulum-summary {
    display: flex; gap: 24px; justify-content: center;
    flex-wrap: wrap; margin-bottom: 40px;
}
.kurikulum-summary-item {
    text-align: center; background: white;
    border-radius: 14px; padding: 20px 28px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    min-width: 120px;
}
.kurikulum-summary-item .num {
    font-size: 2rem; font-weight: 800; color: var(--red-primary); line-height: 1;
}
.kurikulum-summary-item .lbl {
    font-size: 0.78rem; color: #888; margin-top: 4px;
}
@media (max-width: 575.98px) {
    .kurikulum-table th, .kurikulum-table td { padding: 8px 10px; font-size: 0.78rem; }
    .kurikulum-semester-header { padding: 10px 14px; }
}

/* ===== STRUKTUR ===== */
.struktur-section { padding: 80px 0; background: #f8f9fa; }

.pejabat-card {
    background: white; border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    padding: 28px 24px; text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
    border-top: 4px solid transparent;
    border-image: linear-gradient(to right, #8B1A2E, #C0304A, #F09AAA) 1;
}
.pejabat-card:hover { transform: translateY(-6px); box-shadow: 0 16px 45px rgba(0,0,0,0.12); }
.pejabat-foto {
    width: 110px; height: 110px; border-radius: 50%;
    object-fit: cover; margin: 0 auto 16px;
    border: 4px solid #fff;
    box-shadow: 0 6px 20px rgba(139,0,0,0.2);
    display: block;
}
.pejabat-foto-placeholder {
    width: 110px; height: 110px; border-radius: 50%;
    background: linear-gradient(135deg, #C0304A 0%, #8B1A2E 60%, #5C0E1C 100%);
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 2.2rem; font-weight: 800;
    margin: 0 auto 16px;
    box-shadow: 0 6px 20px rgba(139,0,0,0.25);
}
.pejabat-jabatan {
    display: inline-block;
    background: #fff5f5; color: var(--red-primary);
    border: 1px solid rgba(192,48,74,0.15);
    font-size: 0.75rem; font-weight: 700;
    padding: 4px 12px; border-radius: 20px;
    margin-bottom: 10px; text-transform: uppercase;
    letter-spacing: 0.5px;
}
.pejabat-nama { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 6px; }
.pejabat-nidn { font-size: 0.78rem; color: #aaa; margin-bottom: 10px; }
.pejabat-keterangan { font-size: 0.83rem; color: #777; line-height: 1.65; }
.pejabat-kontak a {
    font-size: 0.8rem; color: var(--red-primary); text-decoration: none;
    display: inline-flex; align-items: center; gap: 4px;
}
.pejabat-kontak a:hover { text-decoration: underline; }

@media (max-width: 575.98px) {
    .pejabat-card { padding: 18px 12px; }
    .pejabat-foto { width: 80px; height: 80px; }
    .pejabat-foto-placeholder { width: 80px; height: 80px; font-size: 1.6rem; }
    .pejabat-nama { font-size: 0.85rem; }
    .pejabat-jabatan { font-size: 0.68rem; padding: 3px 8px; }
    .pejabat-nidn, .pejabat-keterangan, .pejabat-kontak a { font-size: 0.72rem; }
}

/* ===== KETUA (highlight first card) ===== */
.pejabat-card.is-ketua {
    border-top-color: var(--gold, #c8a84b);
    background: linear-gradient(180deg, #fffbf0 0%, white 60%);
}
.pejabat-card.is-ketua .pejabat-jabatan {
    background: #fffbf0; color: #b8860b;
    border-color: rgba(200,168,75,0.3);
}
.pejabat-card.is-ketua .pejabat-foto-placeholder {
    background: linear-gradient(135deg, #c8a84b, #a0782e);
}
</style>
@endsection

@section('content')

{{-- PAGE HERO --}}
<div class="page-hero">
    <div class="container-xl">
        <h1 data-aos="fade-right">Struktur Organisasi</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Struktur Organisasi</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ===== SAMBUTAN KEPALA PRODI ===== --}}
@php
    $sambNama    = $site['sambutan_nama']?->value    ?? '';
    $sambJabatan = $site['sambutan_jabatan']?->value  ?? 'Ketua Program Studi';
    $sambFoto    = $site['sambutan_foto']?->value     ?? '';
    $sambIsi     = $site['sambutan_isi']?->value      ?? '';
    $singkatan   = $site['singkatan']?->value         ?? 'PSMPD';
    $namaProdi   = $site['nama_prodi']?->value        ?? 'Program Studi Manajemen Program Doktor';
@endphp

@if($sambNama || $sambIsi)
<section class="sambutan-section">
    <div class="container-xl">
        <div class="row align-items-center g-5">
            <div class="col-lg-4 text-center" data-aos="fade-right">
                <div class="sambutan-photo-wrap d-inline-block">
                    @if($sambFoto)
                        <img src="{{ asset('storage/'.$sambFoto) }}" alt="{{ $sambNama }}" class="sambutan-photo">
                    @else
                        <div class="sambutan-photo-placeholder">
                            <i class="bi bi-person-fill"></i>
                            <span style="font-size:.85rem; margin-top:8px; opacity:.8;">{{ $sambNama ?: $singkatan }}</span>
                        </div>
                    @endif
                    <div class="sambutan-accent">
                        <i class="bi bi-quote"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-8" data-aos="fade-left">
                <div class="sambutan-content">
                    <div class="sambutan-label">
                        <i class="bi bi-chat-quote-fill"></i> Sambutan Kepala Prodi
                    </div>
                    <h2 style="font-size:1.8rem; color:var(--dark); margin-bottom:12px;">
                        Selamat Datang di <span style="color:var(--red-primary);">{{ $singkatan }}</span>
                    </h2>
                    @if($sambIsi)
                        <blockquote class="sambutan-quote">
                            {!! nl2br(e($sambIsi)) !!}
                        </blockquote>
                    @else
                        <blockquote class="sambutan-quote">
                            Selamat datang di {{ $namaProdi }} Fakultas Ekonomi dan Bisnis
                            Universitas 17 Agustus 1945 Semarang. Program studi kami berkomitmen
                            untuk menghasilkan doktor manajemen yang unggul, inovatif, dan
                            berdaya saing global berlandaskan nilai-nilai Pancasila.
                        </blockquote>
                    @endif
                    <div class="sambutan-signature d-flex align-items-center gap-3">
                        <div style="width:48px; height:4px; background:var(--red-primary); border-radius:2px;"></div>
                        <div>
                            <p class="sig-name">{{ $sambNama ?: 'Ketua Program Studi' }}</p>
                            <p class="sig-jabatan">{{ $sambJabatan }}</p>
                            <p class="sig-instansi">{{ $namaProdi }} &bull; FEB UNTAG Semarang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ===== KURIKULUM ===== --}}
@if($kurikulum->count() > 0)
@php
    $bySemester  = $kurikulum->groupBy('semester');
    $totalSks    = $kurikulum->sum('sks');
    $totalWajib  = $kurikulum->where('jenis','wajib')->count();
    $totalPilihan= $kurikulum->where('jenis','pilihan')->count();
@endphp
<section class="kurikulum-section">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>Kurikulum Program Studi</h2>
            <p>Struktur mata kuliah dan beban studi {{ $namaProdi }}</p>
        </div>

        <div class="kurikulum-summary" data-aos="fade-up">
            <div class="kurikulum-summary-item">
                <div class="num">{{ $kurikulum->count() }}</div>
                <div class="lbl">Total Mata Kuliah</div>
            </div>
            <div class="kurikulum-summary-item">
                <div class="num">{{ $totalSks }}</div>
                <div class="lbl">Total SKS</div>
            </div>
            <div class="kurikulum-summary-item">
                <div class="num">{{ $totalWajib }}</div>
                <div class="lbl">MK Wajib</div>
            </div>
            <div class="kurikulum-summary-item">
                <div class="num">{{ $totalPilihan }}</div>
                <div class="lbl">MK Pilihan</div>
            </div>
        </div>

        @foreach($bySemester as $semester => $matkuls)
        <div class="kurikulum-semester-card" data-aos="fade-up">
            <div class="kurikulum-semester-header">
                <h5><i class="bi bi-calendar3 me-2"></i>Semester {{ $semester }}</h5>
                <span class="sks-badge">{{ $matkuls->sum('sks') }} SKS</span>
            </div>
            <div class="table-responsive">
                <table class="kurikulum-table">
                    <thead>
                        <tr>
                            <th style="width:110px">Kode MK</th>
                            <th>Nama Mata Kuliah</th>
                            <th style="width:70px" class="text-center">SKS</th>
                            <th style="width:100px" class="text-center">Jenis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matkuls->sortBy('urutan') as $mk)
                        <tr>
                            <td><span class="mk-kode">{{ $mk->kode_mk ?: '-' }}</span></td>
                            <td>
                                <span class="mk-nama">{{ $mk->nama_mk }}</span>
                                @if($mk->keterangan)
                                    <div style="font-size:.78rem; color:#aaa; margin-top:2px;">{{ $mk->keterangan }}</div>
                                @endif
                            </td>
                            <td class="text-center"><span class="mk-sks">{{ $mk->sks }}</span></td>
                            <td class="text-center">
                                @if($mk->jenis === 'wajib')
                                    <span class="mk-jenis-wajib">Wajib</span>
                                @else
                                    <span class="mk-jenis-pilihan">Pilihan</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ===== STRUKTUR ORGANISASI ===== --}}
<section class="struktur-section">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>Struktur Organisasi</h2>
            <p>Jajaran pimpinan dan staf {{ $namaProdi }} FEB UNTAG Semarang</p>
        </div>

        @php $kataPembuka = $site['struktur_kata_pembuka']?->value ?? ''; @endphp
        @if($kataPembuka)
        <div class="row justify-content-center mb-4" data-aos="fade-up">
            <div class="col-lg-9">
                <div style="background:#fff5f5; border-left:4px solid var(--red-primary); border-radius:0 12px 12px 0; padding:20px 24px;">
                    <p style="color:#444; line-height:1.85; margin:0; font-size:.97rem;">{!! nl2br(e($kataPembuka)) !!}</p>
                </div>
            </div>
        </div>
        @endif

        @if($pejabat->count() > 0)
            <div class="row g-4 justify-content-center">
                @foreach($pejabat as $i => $p)
                <div class="col-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 100 }}">
                    <div class="pejabat-card {{ $i === 0 ? 'is-ketua' : '' }}">
                        @if($p->foto)
                            <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama }}" class="pejabat-foto">
                        @else
                            <div class="pejabat-foto-placeholder">{{ strtoupper(substr($p->nama, 0, 1)) }}</div>
                        @endif
                        <div class="pejabat-jabatan">{{ $p->jabatan }}</div>
                        <div class="pejabat-nama">{{ $p->nama }}</div>
                        @if($p->nidn)
                            <div class="pejabat-nidn">NIDN: {{ $p->nidn }}</div>
                        @endif
                        @if($p->keterangan)
                            <p class="pejabat-keterangan">{{ $p->keterangan }}</p>
                        @endif
                        <div class="pejabat-kontak mt-2">
                            @if($p->email)
                                <a href="mailto:{{ $p->email }}">
                                    <i class="bi bi-envelope"></i> {{ $p->email }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        @else
            <div class="text-center py-5 text-muted">
                <i class="bi bi-people display-3 d-block mb-3 opacity-25"></i>
                <p>Data struktur organisasi belum tersedia.</p>
            </div>
        @endif
    </div>
</section>

@endsection
