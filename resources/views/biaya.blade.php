@extends('layouts.app')
@section('title', 'Biaya Pendidikan - ' . ($site['singkatan']?->value ?? 'PSMPD') . '-FEB UNTAG Semarang')

@section('styles')
<style>
/* Bootstrap Icons class fix for Summernote-rendered content */
.biaya-content .bi::before { display: inline-block; }
/* Ensure table doesn't overflow on mobile */
.biaya-content .table-responsive { border-radius: 14px; }
.biaya-content table { margin-bottom: 0; }
.biaya-content thead th { white-space: nowrap; }
</style>
@endsection

@section('content')

{{-- PAGE HERO --}}
<div class="page-hero">
    <div class="container-xl">
        <div class="d-flex align-items-center gap-3 mb-3">
            <div style="width:52px;height:52px;background:rgba(255,255,255,0.18);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">
                <i class="bi bi-cash-coin"></i>
            </div>
            <div>
                <h1 class="mb-0" style="font-size:1.85rem;">Biaya Pendidikan</h1>
                <p class="mb-0 mt-1" style="opacity:.85;font-size:.88rem;">{{ $site['nama_prodi']?->value ?? 'Program Studi Manajemen Program Doktor' }} – FEB UNTAG Semarang</p>
            </div>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Biaya Pendidikan</li>
            </ol>
        </nav>
    </div>
</div>

{{-- CONTENT FROM HALAMAN --}}
<section style="background:#f8f9fa; padding:60px 0;">
    <div class="container-xl">
        <div class="biaya-content" data-aos="fade-up">
            {!! $halaman->konten !!}
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta-section">
    <div class="container-xl position-relative">
        <div class="row align-items-center g-4">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 style="font-size:2rem; font-weight:700; color:white; margin-bottom:14px;">
                    Siap Berinvestasi untuk Masa Depan?
                </h2>
                <p style="color:rgba(255,255,255,0.88); font-size:1rem; line-height:1.75; max-width:560px; margin:0;">
                    Bergabunglah dengan {{ $site['singkatan']?->value ?? 'PSMPD' }}-FEB UNTAG Semarang dan raih gelar Doktor Manajemen yang diakui secara nasional maupun internasional. Tim kami siap membantu proses pendaftaran Anda.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end d-flex flex-column flex-lg-column gap-3 align-items-start align-items-lg-end" data-aos="fade-left" data-aos-delay="100">
                <a href="{{ route('akademik') }}" class="btn btn-light btn-lg px-4 rounded-3" style="font-weight:700; color:var(--red-primary);">
                    <i class="bi bi-pencil-square me-2"></i>Daftar Sekarang
                </a>
                <a href="{{ route('kontak') }}" class="btn btn-outline-light btn-lg px-4 rounded-3" style="font-weight:600;">
                    <i class="bi bi-chat-left-dots me-2"></i>Konsultasi Biaya
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
