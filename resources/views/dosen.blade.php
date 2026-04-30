@extends('layouts.app')
@section('title', 'Dosen & Staf - PSMPD-FEB UNTAG Semarang')
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-people me-2"></i>Dosen & Staf</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Dosen & Staf</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        @if($dosen->count() > 0)
        <div class="section-title" data-aos="fade-up">
            <h2>Tim Pengajar</h2>
            <p>Dosen berkualifikasi Doktor dan Guru Besar dengan pengalaman riset internasional</p>
        </div>
        <div class="row g-4">
            @foreach($dosen as $d)
            <div class="col-sm-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                <div class="card border-0 shadow-sm rounded-4 h-100 text-center overflow-hidden">
                    <div style="background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); height:6px;"></div>
                    <div class="card-body p-4">
                        <div style="width:90px; height:90px; border-radius:50%; overflow:hidden; margin:0 auto 16px; border:3px solid #ffeeee;">
                            <img src="{{ $d->foto_url }}" alt="{{ $d->nama }}" style="width:100%; height:100%; object-fit:cover;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($d->nama) }}&background=CC0000&color=ffffff&size=90'">
                        </div>
                        <h5 style="font-size:1rem; font-weight:700; color:var(--dark); margin-bottom:4px;">{{ $d->nama }}</h5>
                        <p style="font-size:0.8rem; color:var(--red-primary); font-weight:600; margin-bottom:6px;">{{ $d->jabatan }}</p>
                        @if($d->konsentrasi)
                        <span class="badge rounded-pill mb-3" style="background:#fff5f5; color:var(--red-primary); font-size:0.75rem;">{{ $d->konsentrasi }}</span>
                        @endif
                        @if($d->keahlian)
                        <p style="font-size:0.8rem; color:#888; line-height:1.6; margin-bottom:12px;">{{ $d->keahlian }}</p>
                        @endif
                        @if($d->email || $d->google_scholar)
                        <div class="d-flex gap-2 justify-content-center">
                            @if($d->email)
                            <a href="mailto:{{ $d->email }}" class="btn btn-sm btn-outline-danger rounded-pill" style="font-size:0.75rem; padding:4px 12px;">
                                <i class="bi bi-envelope me-1"></i>Email
                            </a>
                            @endif
                            @if($d->google_scholar)
                            <a href="{{ $d->google_scholar }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill" style="font-size:0.75rem; padding:4px 12px;">
                                <i class="bi bi-book me-1"></i>Scholar
                            </a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-people" style="font-size:4rem; color:#ddd;"></i>
            <p class="text-muted mt-3">Data dosen belum tersedia.</p>
        </div>
        @endif
    </div>
</section>

@endsection
