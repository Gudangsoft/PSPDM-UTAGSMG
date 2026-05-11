@extends('layouts.app')
@section('title', 'Akademik - ' . ($site['singkatan']?->value ?? 'PSMPD') . '-FEB UNTAG Semarang')

@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-book me-2"></i>Akademik</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Akademik</li>
            </ol>
        </nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <ul class="nav nav-pills mb-5 justify-content-center" id="akademikTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-4 py-2" id="kurikulum-tab" data-bs-toggle="pill" data-bs-target="#kurikulum" type="button">
                    <i class="bi bi-list-check me-2"></i>Kurikulum
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-2" id="syarat-tab" data-bs-toggle="pill" data-bs-target="#syarat" type="button">
                    <i class="bi bi-clipboard-check me-2"></i>Syarat Pendaftaran
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-2" id="jadwal-tab" data-bs-toggle="pill" data-bs-target="#jadwal" type="button">
                    <i class="bi bi-calendar3 me-2"></i>Jadwal PMB
                </button>
            </li>
        </ul>

        <div class="tab-content" id="akademikTabContent">
            <div class="tab-pane fade show active" id="kurikulum">
                {!! $halamanMap['akademik-kurikulum']->konten ?? '' !!}
            </div>
            <div class="tab-pane fade" id="syarat">
                {!! $halamanMap['akademik-syarat-pendaftaran']->konten ?? '' !!}
            </div>
            <div class="tab-pane fade" id="jadwal">
                {!! $halamanMap['akademik-jadwal-pmb']->konten ?? '' !!}
            </div>
        </div>
    </div>
</section>

<style>
.nav-pills .nav-link { color: var(--dark); border-radius: 50px; margin: 0 4px; }
.nav-pills .nav-link.active { background: var(--red-primary); }
</style>

@endsection
