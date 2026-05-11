@extends('layouts.app')
@section('title', 'Tentang Program - PSMPD-FEB UNTAG Semarang')
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-info-circle me-2"></i>Tentang Program</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Tentang Program</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                @php $tentangGambar = $site['tentang_gambar']?->value ?? null; @endphp
                @if($tentangGambar)
                <div class="rounded-4 overflow-hidden shadow-sm mb-4" style="width:100%;">
                    <img src="{{ asset('storage/' . $tentangGambar) }}"
                         alt="Tentang Program"
                         style="width:100%;height:auto;display:block;">
                </div>
                @endif
                <span class="badge" style="background:var(--red-primary); color:white; padding:6px 14px; border-radius:20px; font-size:0.8rem; margin-bottom:16px; display:inline-block;">Program Doktor</span>
                <h2 style="font-size:1.8rem; font-weight:700; color:var(--dark); margin-bottom:16px;">Program Studi Manajemen Program Doktor FEB UNTAG Semarang</h2>
                <p class="text-muted" style="line-height:1.8;">Program Studi Manajemen Program Doktor (PSMPD) Fakultas Ekonomi dan Bisnis Universitas 17 Agustus 1945 Semarang hadir sebagai pusat unggulan riset dan pengembangan teori manajemen berbasis nilai-nilai Pancasila.</p>
                <p class="text-muted" style="line-height:1.8;">Program ini berorientasi pada transformasi strategis organisasi dan kelembagaan, untuk melahirkan pemikiran manajemen Indonesia yang orisinal, inovatif, dan berdaya saing global.</p>
                <div class="row g-3 mt-2">
                    <div class="col-4">
                        <div class="d-flex align-items-center gap-2 p-3 rounded-3" style="background:#fff5f5;">
                            <i class="bi bi-award text-danger fs-5"></i>
                            <div><small class="text-muted d-block">Akreditasi</small><strong>{{ $site['info_akreditasi']?->value ?? 'Unggul (A)' }}</strong></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-items-center gap-2 p-3 rounded-3" style="background:#fff5f5;">
                            <i class="bi bi-clock text-danger fs-5"></i>
                            <div><small class="text-muted d-block">Durasi Studi</small><strong>{{ $site['info_durasi']?->value ?? '6 Semester' }}</strong></div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-items-center gap-2 p-3 rounded-3" style="background:#fff5f5;">
                            <i class="bi bi-book text-danger fs-5"></i>
                            <div><small class="text-muted d-block">Total SKS</small><strong>{{ $site['info_sks']?->value ?? '42 SKS' }}</strong></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div style="background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); padding:30px; color:white;">
                        <h5 class="mb-0" style="font-family:'Inter',sans-serif; font-weight:700;"><i class="bi bi-eye me-2"></i>Visi Program Studi</h5>
                    </div>
                    <div class="card-body p-4">
                        <p style="font-size:1rem; line-height:1.8; font-style:italic; color:#444;">
                            "{{ $site['visi']?->value ?? 'Menjadi Program Studi Manajemen Doktor yang unggul, inovatif, dan berdaya saing global, berbasis nilai-nilai Pancasila dalam pengembangan ilmu manajemen untuk transformasi bangsa.' }}"
                        </p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mt-4">
                    <div style="background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); padding:30px; color:white;">
                        <h5 class="mb-0" style="font-family:'Inter',sans-serif; font-weight:700;"><i class="bi bi-bullseye me-2"></i>Misi Program Studi</h5>
                    </div>
                    <div class="card-body p-4">
                        <ul class="list-unstyled mb-0" style="font-size:0.875rem; line-height:1.8; color:#444;">
                            @php
                                $misiList = array_filter(array_map('trim', explode("\n", $site['misi']?->value ?? '')));
                                if (empty($misiList)) $misiList = [
                                    'Menyelenggarakan pendidikan doktoral yang berkualitas dan berbasis riset.',
                                    'Menghasilkan karya ilmiah bereputasi internasional yang inovatif.',
                                    'Mengembangkan kerjasama dengan industri, pemerintah, dan lembaga internasional.',
                                    'Memberikan kontribusi nyata bagi pembangunan bangsa berbasis ilmu manajemen.',
                                ];
                            @endphp
                            @foreach($misiList as $loop2 => $m)
                            <li class="d-flex gap-2 {{ !$loop->last ? 'mb-3' : '' }}">
                                <i class="bi bi-check-circle-fill text-danger flex-shrink-0 mt-1"></i> {{ $m }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Struktur Organisasi --}}
<section class="py-5" style="background:#f8f8f8;">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>Struktur Organisasi</h2>
            <p>Tim pimpinan yang berdedikasi untuk kemajuan program studi</p>
        </div>
        <div class="row g-4 justify-content-center">
            @php
                $pimpinan = [
                    ['jabatan' => 'Ketua Program Studi', 'icon' => 'bi-person-badge-fill'],
                    ['jabatan' => 'Sekretaris Program Studi', 'icon' => 'bi-person-lines-fill'],
                    ['jabatan' => 'Koordinator Akademik', 'icon' => 'bi-journal-bookmark-fill'],
                    ['jabatan' => 'Koordinator Kemahasiswaan', 'icon' => 'bi-people-fill'],
                ];
            @endphp
            @foreach($pimpinan as $p)
            <div class="col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="text-center p-4 bg-white rounded-4 shadow-sm h-100">
                    <div style="width:64px; height:64px; background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:1.6rem; color:white;">
                        <i class="{{ $p['icon'] }}"></i>
                    </div>
                    <h6 style="font-weight:700; color:var(--dark); font-size:0.875rem;">{{ $p['jabatan'] }}</h6>
                    <p class="text-muted mb-0" style="font-size:0.8rem;">PSMPD-FEB UNTAG Semarang</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
