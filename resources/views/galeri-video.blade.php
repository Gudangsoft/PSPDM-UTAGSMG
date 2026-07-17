@extends('layouts.app')
@section('title', 'Galeri Video - PSMPD-FEB UNTAG Semarang')
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-play-circle me-2"></i>Galeri Video</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Galeri Video</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <div class="text-center mb-4">
            <a href="{{ route('galeri') }}" class="btn btn-sm btn-outline-primary rounded-pill"><i class="bi bi-images me-1"></i>Lihat Galeri Foto</a>
        </div>

        {{-- Filter --}}
        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
            <a href="{{ route('galeri-video') }}" class="btn btn-sm rounded-pill {{ !request('platform') ? 'btn-primary' : 'btn-outline-secondary' }}">Semua</a>
            <a href="{{ route('galeri-video', ['platform' => 'youtube']) }}" class="btn btn-sm rounded-pill {{ request('platform') == 'youtube' ? 'btn-primary' : 'btn-outline-secondary' }}"><i class="bi bi-youtube me-1"></i>YouTube</a>
            <a href="{{ route('galeri-video', ['platform' => 'instagram']) }}" class="btn btn-sm rounded-pill {{ request('platform') == 'instagram' ? 'btn-primary' : 'btn-outline-secondary' }}"><i class="bi bi-instagram me-1"></i>Instagram</a>
            <a href="{{ route('galeri-video', ['platform' => 'tiktok']) }}" class="btn btn-sm rounded-pill {{ request('platform') == 'tiktok' ? 'btn-primary' : 'btn-outline-secondary' }}"><i class="bi bi-tiktok me-1"></i>TikTok</a>
        </div>

        @if($videos->count() > 0)
        <div class="row g-4">
            @foreach($videos as $v)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 80 }}">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    @if($v->platform === 'youtube' && $v->embed_url)
                    <div class="ratio ratio-16x9" style="background:#000;">
                        <iframe src="{{ $v->embed_url }}" title="{{ $v->judul }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
                    </div>
                    @elseif($v->platform === 'instagram')
                    <div class="d-flex justify-content-center" style="background:#fafafa; padding:8px;">
                        <blockquote class="instagram-media" data-instgrm-permalink="{{ $v->url }}" data-instgrm-version="14" style="width:100%; max-width:340px; margin:0;"></blockquote>
                    </div>
                    @elseif($v->platform === 'tiktok' && $v->tiktok_is_profile)
                    <div class="d-flex justify-content-center" style="background:#fafafa; padding:8px;">
                        <blockquote class="tiktok-embed" cite="{{ $v->url }}" data-unique-id="{{ $v->tiktok_username }}" data-embed-type="creator" style="max-width:340px; min-width:280px; margin:0;">
                            <section><a target="_blank" href="{{ $v->url }}">@{{ $v->tiktok_username }}</a></section>
                        </blockquote>
                    </div>
                    @elseif($v->platform === 'tiktok')
                    <div class="d-flex justify-content-center" style="background:#fafafa; padding:8px;">
                        <blockquote class="tiktok-embed" cite="{{ $v->url }}" style="max-width:340px; min-width:280px; margin:0;"><section></section></blockquote>
                    </div>
                    @else
                    <div class="d-flex align-items-center justify-content-center text-muted" style="height:200px; background:#f5f5f5;">
                        <i class="bi bi-exclamation-triangle me-2"></i>Video tidak dapat dimuat
                    </div>
                    @endif
                    <div class="card-body p-3">
                        <span class="badge rounded-pill mb-2" style="background:#f0f4ff; color:#1a1a2e; font-size:.75rem;"><i class="bi {{ $v->platform_icon }} me-1"></i>{{ $v->platform_label }}</span>
                        <h6 class="mb-1" style="font-weight:700;">{{ $v->judul }}</h6>
                        @if($v->deskripsi)
                        <p class="text-muted mb-0" style="font-size:.82rem;">{{ Str::limit($v->deskripsi, 100) }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $videos->links() }}</div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-play-circle" style="font-size:4rem; color:#ddd;"></i>
            <p class="text-muted mt-3">Belum ada video dalam galeri.</p>
        </div>
        @endif
    </div>
</section>
@endsection
@section('scripts')
@if($videos->contains('platform', 'instagram'))
<script async src="https://www.instagram.com/embed.js"></script>
@endif
@if($videos->contains('platform', 'tiktok'))
<script async src="https://www.tiktok.com/embed.js"></script>
@endif
@endsection
