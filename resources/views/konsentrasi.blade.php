@extends('layouts.app')
@section('title', 'Konsentrasi Program Studi - ' . ($site['singkatan']?->value ?? 'PSMPD') . '-FEB UNTAG Semarang')

@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-diagram-3 me-2"></i>Konsentrasi Program Studi</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Konsentrasi</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5" style="background:white;">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>Konsentrasi Unggulan</h2>
            <p>Dirancang untuk menghasilkan doktor manajemen yang spesialis dan berkompeten di bidangnya</p>
        </div>

        @foreach($konsentrasis as $i => $k)
        @php $reverse = $i % 2 !== 0; @endphp
        <div class="row g-5 align-items-center mb-5 pb-5 {{ !$loop->last ? 'border-bottom' : '' }}"
             id="konsentrasi-{{ $k->id }}">

            {{-- Image Card --}}
            <div class="col-lg-5 {{ $reverse ? 'order-lg-2' : '' }}" data-aos="{{ $reverse ? 'fade-left' : 'fade-right' }}">
                <div style="background:linear-gradient(135deg,{{ $k->warna_primer }},{{ $k->warna_sekunder }});border-radius:20px;overflow:hidden;position:relative;">
                    @if($k->gambar)
                        <img src="{{ asset('storage/' . $k->gambar) }}"
                             alt="{{ $k->nama }}"
                             style="width:100%;aspect-ratio:4/3;object-fit:cover;display:block;">
                    @else
                        <div style="padding:50px;color:white;text-align:center;">
                            <div style="font-size:5rem;margin-bottom:20px;line-height:1;">
                                <i class="bi {{ $k->ikon ?? 'bi-diagram-3' }}"></i>
                            </div>
                        </div>
                    @endif
                    <div style="position:absolute;bottom:0;left:0;right:0;padding:20px 24px;background:linear-gradient(to top,rgba(0,0,0,.65),transparent);color:white;">
                        <h3 style="font-size:1.1rem;font-weight:700;margin-bottom:4px;">{{ $k->nama }}</h3>
                        @if($k->nama_en)
                        <p style="opacity:.85;font-size:.78rem;margin:0;">{{ $k->nama_en }}</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="col-lg-7 {{ $reverse ? 'order-lg-1' : '' }}" data-aos="{{ $reverse ? 'fade-right' : 'fade-left' }}">
                <span style="display:inline-block;background:{{ $k->warna_primer }};color:white;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:700;margin-bottom:16px;">
                    Konsentrasi {{ $k->urutan }}
                </span>
                <h3 style="font-size:1.6rem;font-weight:700;color:var(--dark);margin-bottom:16px;">{{ $k->nama }}</h3>
                <p class="text-muted" style="line-height:1.8;">{{ $k->deskripsi }}</p>
                @if($k->deskripsi_lanjutan)
                <p class="text-muted" style="line-height:1.8;">{{ $k->deskripsi_lanjutan }}</p>
                @endif

                @if($k->topik && count($k->topik))
                <h6 style="font-weight:700;color:var(--dark);margin-top:20px;margin-bottom:12px;">Topik Kajian Utama:</h6>
                <div style="display:flex;flex-wrap:wrap;gap:8px;">
                    @foreach($k->topik as $topik)
                    <span style="background:{{ $k->warna_primer }}18;color:{{ $k->warna_primer }};border:1px solid {{ $k->warna_primer }}44;padding:6px 14px;border-radius:20px;font-size:.78rem;font-weight:600;">
                        {{ $topik }}
                    </span>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endforeach

        @if($konsentrasis->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-diagram-3 fs-1 d-block mb-3 opacity-30"></i>
            <p>Konsentrasi belum tersedia.</p>
        </div>
        @endif
    </div>
</section>

@endsection
