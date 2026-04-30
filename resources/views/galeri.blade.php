@extends('layouts.app')
@section('title', 'Galeri - PSMPD-FEB UNTAG Semarang')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
@endsection
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-images me-2"></i>Galeri Kegiatan</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Galeri</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        {{-- Filter --}}
        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
            <a href="{{ route('galeri') }}" class="btn btn-sm rounded-pill {{ !request('kategori') ? 'btn-primary' : 'btn-outline-secondary' }}">Semua</a>
            @foreach($kategoris as $kat)
            <a href="{{ route('galeri', ['kategori' => $kat]) }}" class="btn btn-sm rounded-pill {{ request('kategori') == $kat ? 'btn-primary' : 'btn-outline-secondary' }}">{{ $kat }}</a>
            @endforeach
        </div>

        @if($galeri->count() > 0)
        <div class="row g-3">
            @foreach($galeri as $foto)
            <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 4) * 60 }}">
                <a href="{{ $foto->gambar_url }}" class="glightbox" data-gallery="galeri" data-description="{{ $foto->judul }}">
                    <div style="position:relative; overflow:hidden; border-radius:12px; cursor:pointer;">
                        <img src="{{ $foto->gambar_url }}" alt="{{ $foto->judul }}" style="width:100%; height:200px; object-fit:cover; transition:transform .4s;" class="galeri-thumb" onerror="this.src='https://via.placeholder.com/300x200/CC0000/fff?text=Foto'">
                        <div style="position:absolute; inset:0; background:rgba(192,48,74,0.75); display:flex; flex-direction:column; align-items:center; justify-content:center; opacity:0; transition:opacity .3s; border-radius:12px; padding:16px;" class="galeri-overlay">
                            <i class="bi bi-zoom-in text-white" style="font-size:1.8rem; margin-bottom:6px;"></i>
                            <small class="text-white text-center fw-600" style="font-size:0.78rem;">{{ $foto->judul }}</small>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $galeri->links() }}</div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-images" style="font-size:4rem; color:#ddd;"></i>
            <p class="text-muted mt-3">Belum ada foto dalam galeri.</p>
        </div>
        @endif
    </div>
</section>

<style>
.galeri-thumb:hover { transform:scale(1.08); }
div:hover .galeri-overlay { opacity:1 !important; }
.pagination .page-link { color:var(--red-primary); }
.pagination .page-item.active .page-link { background:var(--red-primary); border-color:var(--red-primary); }
</style>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>GLightbox({ selector: '.glightbox' });</script>
@endsection
