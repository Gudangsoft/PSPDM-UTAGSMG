@extends('layouts.app')
@section('title', 'Pengumuman - PSMPD-FEB UNTAG Semarang')
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-bell me-2"></i>Pengumuman</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Pengumuman</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        @if($pengumuman->count() > 0)
        <div class="row g-3">
            @foreach($pengumuman as $item)
            <div class="col-12" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex gap-4 align-items-start">
                            <div class="text-center p-3 rounded-3 flex-shrink-0" style="background:#fff5f5; min-width:70px;">
                                <div style="font-size:1.5rem; font-weight:800; color:var(--red-primary); line-height:1;">{{ $item->tanggal_mulai->format('d') }}</div>
                                <div style="font-size:0.72rem; color:#888; text-transform:uppercase; font-weight:600;">{{ $item->tanggal_mulai->isoFormat('MMM Y') }}</div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h5 style="font-size:1rem; font-weight:700; color:var(--dark); margin-bottom:8px;">
                                        <a href="{{ route('pengumuman.show', $item) }}" class="text-decoration-none" style="color:inherit;">{{ $item->judul }}</a>
                                    </h5>
                                    @if($item->file_lampiran)
                                    <a href="{{ asset('storage/'.$item->file_lampiran) }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill flex-shrink-0 ms-2" style="font-size:0.75rem;">
                                        <i class="bi bi-download me-1"></i>Unduh
                                    </a>
                                    @endif
                                </div>
                                <p class="text-muted mb-2" style="font-size:0.875rem; line-height:1.65;">{{ Str::limit($item->konten, 200) }}</p>
                                @if($item->tanggal_selesai)
                                <small class="text-muted"><i class="bi bi-calendar-range me-1"></i>Berlaku hingga: {{ $item->tanggal_selesai->isoFormat('D MMMM Y') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $pengumuman->links() }}</div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-bell" style="font-size:4rem; color:#ddd;"></i>
            <p class="text-muted mt-3">Belum ada pengumuman aktif.</p>
        </div>
        @endif
    </div>
</section>

<style>.pagination .page-link { color:var(--red-primary); } .pagination .page-item.active .page-link { background:var(--red-primary); border-color:var(--red-primary); }</style>
@endsection
