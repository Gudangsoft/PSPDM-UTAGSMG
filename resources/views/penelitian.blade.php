@extends('layouts.app')
@section('title', 'Penelitian - PSMPD-FEB UNTAG Semarang')
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-journal-richtext me-2"></i>Penelitian</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Penelitian</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>Unggulan Riset</h2>
            <p>PSMPD-FEB UNTAG berkomitmen pada penelitian berkualitas tinggi yang berdampak bagi masyarakat</p>
        </div>

        <div class="d-flex flex-column gap-4 mb-5">
            @foreach($riset as $r)
            <div class="card border-0 shadow-sm rounded-4" style="border-left:4px solid {{ $r->warna }}!important;"
                 data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="card-body p-4">
                    <h5 style="font-size:1rem; font-weight:700; color:var(--dark); margin-bottom:4px;">{{ $r->judul }}</h5>
                    @if($r->deskripsi)
                    <p class="text-muted mb-3" style="font-size:0.82rem;">{{ $r->deskripsi }}</p>
                    @endif
                    <div class="row g-2">
                        @foreach([['a','Riset a'],['b','Riset b'],['c','Riset c']] as [$key,$lbl])
                        @if($r->{'topik_'.$key})
                        <div class="col-md-4">
                            <div class="p-3 rounded-3 h-100" style="background:#f8fafc; border:1px solid #e2e8f0;">
                                <span class="badge mb-2" style="background:{{ $r->warna }}; font-size:.68rem;">{{ $lbl }}</span>
                                <p class="mb-0" style="font-size:.82rem; color:#374151; line-height:1.5;">{{ $r->{'topik_'.$key} }}</p>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center py-5" style="background:#f8f8f8; border-radius:20px;" data-aos="fade-up">
            <i class="bi bi-journal-richtext" style="font-size:4rem; color:#ddd;"></i>
            <h5 class="mt-3 text-muted">Database publikasi akan segera tersedia</h5>
            <p class="text-muted" style="font-size:0.875rem;">Kami sedang mempersiapkan direktori penelitian dan publikasi ilmiah dosen.</p>
            <a href="{{ route('kontak') }}" class="btn btn-outline-primary mt-2">Hubungi Kami untuk Kolaborasi</a>
        </div>
    </div>
</section>

@endsection
