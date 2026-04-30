@extends('layouts.app')
@section('title', 'Berita - PSMPD-FEB UNTAG Semarang')
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-newspaper me-2"></i>Berita & Artikel</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Berita</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        {{-- Filter --}}
        <div class="d-flex flex-wrap gap-2 mb-4 align-items-center justify-content-between">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('berita.index') }}" class="btn btn-sm rounded-pill {{ !request('kategori') ? 'btn-primary' : 'btn-outline-secondary' }}">Semua</a>
                @foreach($kategoris as $kat)
                <a href="{{ route('berita.index', ['kategori' => $kat]) }}" class="btn btn-sm rounded-pill {{ request('kategori') == $kat ? 'btn-primary' : 'btn-outline-secondary' }}">{{ $kat }}</a>
                @endforeach
            </div>
            <form action="{{ route('berita.index') }}" method="GET" class="d-flex gap-2">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm rounded-pill" placeholder="Cari berita..." style="width:200px;">
                <button type="submit" class="btn btn-sm btn-primary rounded-pill"><i class="bi bi-search"></i></button>
            </form>
        </div>

        @if($berita->count() > 0)
        <div class="row g-4">
            @foreach($berita as $item)
            <div class="col-md-6 col-lg-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <div style="height:210px; overflow:hidden;">
                        <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}" style="width:100%; height:100%; object-fit:cover; transition:transform .3s;" class="card-img-hover" onerror="this.src='https://via.placeholder.com/400x210/CC0000/ffffff?text=Berita'">
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <span class="badge rounded-pill" style="background:var(--red-primary); color:white; font-size:0.72rem;">{{ $item->kategori }}</span>
                            <small class="text-muted"><i class="bi bi-clock me-1"></i>{{ $item->published_at?->isoFormat('D MMM Y') }}</small>
                        </div>
                        <h5 style="font-size:0.95rem; font-weight:700; line-height:1.45; color:var(--dark); margin-bottom:10px;">{{ $item->judul }}</h5>
                        <p class="text-muted" style="font-size:0.82rem; line-height:1.65;">{{ Str::limit($item->ringkasan ?? strip_tags($item->konten), 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                            <small class="text-muted"><i class="bi bi-eye me-1"></i>{{ $item->views }} views</small>
                            <a href="{{ route('berita.show', $item->slug) }}" class="btn btn-sm btn-outline-danger rounded-pill" style="font-size:0.78rem;">Baca <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $berita->links() }}</div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-newspaper" style="font-size:4rem; color:#ddd;"></i>
            <p class="text-muted mt-3">Belum ada berita yang tersedia.</p>
        </div>
        @endif
    </div>
</section>

<style>
.card:hover .card-img-hover { transform: scale(1.05); }
.pagination .page-link { color: var(--red-primary); }
.pagination .page-item.active .page-link { background:var(--red-primary); border-color:var(--red-primary); }
</style>
@endsection
