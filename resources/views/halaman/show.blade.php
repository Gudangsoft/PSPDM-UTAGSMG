@extends('layouts.app')
@section('title', $halaman->judul . ' - ' . ($site['singkatan']?->value ?? 'PSMPD'))

@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1 data-aos="fade-right">{{ $halaman->judul }}</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">{{ $halaman->judul }}</li>
            </ol>
        </nav>
    </div>
</div>

<section style="padding: 60px 0; background: white;">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div style="font-size:1rem; line-height:1.85; color:#333;">
                    {!! $halaman->konten !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@if(str_contains($halaman->konten ?? '', 'tally.so'))
@section('scripts')
<script>
var d=document,w="https://tally.so/widgets/embed.js",v=function(){"undefined"!=typeof Tally?Tally.loadEmbeds():d.querySelectorAll("iframe[data-tally-src]:not([src])").forEach((function(e){e.src=e.dataset.tallySrc}))};if("undefined"!=typeof Tally)v();else if(d.querySelector('script[src="'+w+'"]')==null){var s=d.createElement("script");s.src=w,s.onload=v,s.onerror=v,d.body.appendChild(s);}
</script>
@endsection
@endif
