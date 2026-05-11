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
        <div data-aos="fade-up">
            {!! $halaman->konten !!}
        </div>
    </div>
</section>

@endsection
