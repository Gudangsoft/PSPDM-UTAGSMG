@extends('layouts.app')
@section('title', $pengumuman->judul . ' - PSMPD-FEB UNTAG')
@section('og_title', $pengumuman->judul)
@section('og_description', Str::limit(strip_tags($pengumuman->konten), 160))
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1 style="font-size:1.4rem;">{{ Str::limit($pengumuman->judul, 70) }}</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pengumuman.index') }}">Pengumuman</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-5">
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge rounded-pill" style="background:var(--red-primary); color:white;">Pengumuman</span>
                            <small class="text-muted"><i class="bi bi-calendar me-1"></i>{{ $pengumuman->tanggal_mulai->isoFormat('D MMMM Y') }}</small>
                            @if($pengumuman->tanggal_selesai)
                            <small class="text-muted"> – {{ $pengumuman->tanggal_selesai->isoFormat('D MMMM Y') }}</small>
                            @endif
                        </div>
                        <h1 style="font-size:1.6rem; font-weight:700; color:var(--dark); margin-bottom:24px;">{{ $pengumuman->judul }}</h1>
                        <div style="font-size:0.95rem; line-height:1.85; color:#444;">{!! nl2br(e($pengumuman->konten)) !!}</div>
                        @if($pengumuman->file_lampiran)
                        <div class="mt-4 pt-4 border-top">
                            <a href="{{ asset('storage/'.$pengumuman->file_lampiran) }}" target="_blank" class="btn btn-primary">
                                <i class="bi bi-download me-2"></i>Unduh Lampiran
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2 align-items-center flex-wrap">
                    <a href="{{ route('pengumuman.index') }}" class="btn btn-outline-secondary rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <span class="text-muted" style="font-size:.85rem;">Bagikan:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill"><i class="bi bi-facebook me-1"></i>Facebook</a>
                    <a href="https://wa.me/?text={{ urlencode($pengumuman->judul.' '.url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill"><i class="bi bi-whatsapp me-1"></i>WhatsApp</a>
                    <button onclick="navigator.clipboard.writeText('{{ url()->current() }}');this.innerHTML='<i class=\'bi bi-check\' ></i> Disalin!'" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-link me-1"></i>Salin Link</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
