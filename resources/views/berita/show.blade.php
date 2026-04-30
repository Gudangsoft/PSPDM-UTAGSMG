@extends('layouts.app')
@section('title', $berita->judul . ' - PSMPD-FEB UNTAG')
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1 style="font-size:1.4rem;">{{ Str::limit($berita->judul, 70) }}</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-lg-8">
                <article>
                    <div class="d-flex gap-2 align-items-center mb-3">
                        <span class="badge rounded-pill" style="background:var(--red-primary); color:white;">{{ $berita->kategori }}</span>
                        <small class="text-muted"><i class="bi bi-calendar me-1"></i>{{ $berita->published_at?->isoFormat('dddd, D MMMM Y') }}</small>
                        <small class="text-muted"><i class="bi bi-person me-1"></i>{{ $berita->penulis }}</small>
                        <small class="text-muted ms-auto"><i class="bi bi-eye me-1"></i>{{ $berita->views }}</small>
                    </div>
                    <h1 style="font-size:1.7rem; font-weight:700; color:var(--dark); line-height:1.4; margin-bottom:20px;">{{ $berita->judul }}</h1>

                    @if($berita->gambar)
                    <div class="mb-4 rounded-4 overflow-hidden">
                        <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}" style="width:100%; max-height:400px; object-fit:cover;">
                    </div>
                    @endif

                    <div class="article-content" style="font-size:0.95rem; line-height:1.85; color:#444;">
                        {!! $berita->konten !!}
                    </div>

                    <div class="mt-4 pt-4 border-top d-flex gap-2 align-items-center">
                        <span class="text-muted" style="font-size:0.85rem;">Bagikan:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill"><i class="bi bi-facebook me-1"></i>Facebook</a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill"><i class="bi bi-twitter-x me-1"></i>Twitter</a>
                        <a href="https://wa.me/?text={{ urlencode($berita->judul.' '.url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-pill"><i class="bi bi-whatsapp me-1"></i>WhatsApp</a>
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header" style="background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); color:white; border-radius:16px 16px 0 0; padding:16px 20px;">
                        <h6 class="mb-0 fw-bold"><i class="bi bi-newspaper me-2"></i>Berita Terkait</h6>
                    </div>
                    <div class="card-body p-0">
                        @forelse($terkait as $item)
                        <a href="{{ route('berita.show', $item->slug) }}" class="d-flex gap-3 p-3 text-decoration-none border-bottom" style="color:inherit;">
                            <img src="{{ $item->gambar_url }}" alt="" style="width:70px; height:55px; object-fit:cover; border-radius:8px; flex-shrink:0;" onerror="this.src='https://via.placeholder.com/70x55/CC0000/fff?text=B'">
                            <div>
                                <p class="mb-1 fw-600" style="font-size:0.82rem; font-weight:600; line-height:1.35; color:var(--dark);">{{ Str::limit($item->judul, 60) }}</p>
                                <small class="text-muted">{{ $item->published_at?->isoFormat('D MMM Y') }}</small>
                            </div>
                        </a>
                        @empty
                        <p class="text-muted p-3 mb-0" style="font-size:0.85rem;">Tidak ada berita terkait.</p>
                        @endforelse
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4" style="background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); color:white;">
                    <div class="card-body p-4 text-center">
                        <i class="bi bi-pencil-square" style="font-size:2.5rem; opacity:0.8; margin-bottom:12px; display:block;"></i>
                        <h6 class="fw-bold">Daftar Program Doktor</h6>
                        <p style="font-size:0.82rem; opacity:0.85; margin:8px 0 16px;">Bergabunglah dengan komunitas akademisi terbaik Indonesia</p>
                        <a href="{{ route('akademik') }}" class="btn btn-light btn-sm rounded-pill">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.article-content img { max-width:100%; border-radius:8px; margin:16px 0; }
.article-content p { margin-bottom:1.2rem; }
.article-content h2, .article-content h3 { color:var(--dark); margin:1.5rem 0 .8rem; font-weight:700; }
</style>
@endsection
