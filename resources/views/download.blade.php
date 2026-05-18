@extends('layouts.app')
@section('title', 'Pusat Unduhan - ' . ($site['singkatan']?->value ?? 'PSMPD') . '-FEB UNTAG Semarang')
@section('og_title', 'Pusat Unduhan – ' . ($site['singkatan']?->value ?? 'PSMPD') . ' FEB UNTAG Semarang')
@section('og_description', 'Unduh formulir, SK, panduan, dan dokumen resmi Program Studi ' . ($site['nama_prodi']?->value ?? 'Manajemen Program Doktor') . ' FEB UNTAG Semarang.')

@section('styles')
<style>
/* ── Download page ─────────────────────────────────────────────────────── */
.dl-category-header {
    background: linear-gradient(135deg, var(--red-primary) 0%, var(--red-dark) 100%);
    color: #fff;
    padding: 10px 20px;
    border-radius: 10px 10px 0 0;
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    font-size: 0.92rem;
    letter-spacing: 0.4px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.dl-list {
    background: #fff;
    border-radius: 0 0 12px 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    overflow: hidden;
}
.dl-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px 20px;
    border-bottom: 1px solid #f0f0f0;
    transition: background 0.18s;
}
.dl-row:last-child { border-bottom: none; }
.dl-row:hover { background: #fff8f9; }
.dl-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 1.25rem;
}
.dl-icon-pdf  { background: #fff0f2; color: #C0304A; }
.dl-icon-word { background: #f0f4ff; color: #2B579A; }
.dl-icon-zip  { background: #fff8f0; color: #D4800A; }
.dl-icon-other{ background: #f5f5f5; color: #555; }
.dl-info { flex: 1; min-width: 0; }
.dl-info .dl-title { font-weight: 600; font-size: 0.9rem; color: var(--dark); margin-bottom: 2px; }
.dl-info .dl-desc  { font-size: 0.78rem; color: var(--gray-text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.dl-meta { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
.dl-size-badge {
    background: #f0f0f0;
    color: #666;
    font-size: 0.72rem;
    font-weight: 600;
    padding: 3px 9px;
    border-radius: 20px;
    white-space: nowrap;
}
.btn-unduh {
    color: var(--red-primary);
    border: 1.5px solid var(--red-primary);
    background: transparent;
    padding: 5px 14px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
}
.btn-unduh:hover {
    background: linear-gradient(135deg, var(--red-primary), var(--red-dark));
    color: #fff;
    border-color: var(--red-dark);
    box-shadow: 0 3px 12px rgba(192,48,74,0.3);
}
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: var(--gray-text);
}
.empty-state i { font-size: 3.5rem; color: #ddd; display: block; margin-bottom: 16px; }

@media (max-width: 576px) {
    .dl-row { flex-wrap: wrap; gap: 10px; }
    .dl-meta { width: 100%; justify-content: flex-end; }
    .dl-info .dl-desc { white-space: normal; }
}
</style>
@endsection

@section('content')

{{-- ── PAGE HERO ──────────────────────────────────────────────────────────── --}}
<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-download me-2"></i>Pusat Unduhan</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Pusat Unduhan</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── MAIN CONTENT ───────────────────────────────────────────────────────── --}}
<section class="py-5" style="background:#f8f9fa;">
    <div class="container-xl">

        @if($downloads->isEmpty())
            {{-- Empty state --}}
            <div class="empty-state">
                <i class="bi bi-folder2-open"></i>
                <h5 style="font-weight:700; color:var(--dark);">Belum Ada Dokumen</h5>
                <p class="text-muted" style="max-width:420px; margin:0 auto;">
                    Saat ini belum ada dokumen yang tersedia untuk diunduh. Silakan kunjungi kembali halaman ini secara berkala.
                </p>
            </div>
        @else
            <div class="d-flex flex-column gap-4">
                @foreach($downloads as $kategori => $items)
                @php
                    $icons = [
                        'Formulir' => 'bi-file-earmark-text',
                        'SK'       => 'bi-file-earmark-ruled',
                        'Panduan'  => 'bi-book',
                    ];
                    $catIcon = $icons[$kategori] ?? 'bi-folder2';
                @endphp

                <div data-aos="fade-up">
                    {{-- Category header --}}
                    <div class="dl-category-header">
                        <i class="bi {{ $catIcon }}"></i>
                        {{ $kategori ?: 'Lainnya' }}
                        <span class="ms-auto badge bg-white bg-opacity-25 fw-normal" style="font-size:0.75rem;">
                            {{ $items->count() }} dokumen
                        </span>
                    </div>

                    {{-- Download rows --}}
                    <div class="dl-list">
                        @foreach($items as $d)
                        @php
                            // Determine file extension from file_url accessor
                            $ext = strtolower(pathinfo(parse_url($d->file_url, PHP_URL_PATH), PATHINFO_EXTENSION));
                            if (in_array($ext, ['pdf'])) {
                                $iconClass = 'bi-file-pdf';
                                $iconStyle = 'dl-icon-pdf';
                            } elseif (in_array($ext, ['doc', 'docx'])) {
                                $iconClass = 'bi-file-word';
                                $iconStyle = 'dl-icon-word';
                            } elseif (in_array($ext, ['zip', 'rar', '7z', 'gz'])) {
                                $iconClass = 'bi-file-earmark-zip';
                                $iconStyle = 'dl-icon-zip';
                            } else {
                                $iconClass = 'bi-file-earmark';
                                $iconStyle = 'dl-icon-other';
                            }
                        @endphp
                        <div class="dl-row">
                            {{-- File type icon --}}
                            <div class="dl-icon {{ $iconStyle }}">
                                <i class="bi {{ $iconClass }}"></i>
                            </div>

                            {{-- Title & description --}}
                            <div class="dl-info">
                                <div class="dl-title">{{ $d->judul }}</div>
                                @if($d->deskripsi)
                                    <div class="dl-desc" title="{{ $d->deskripsi }}">{{ $d->deskripsi }}</div>
                                @endif
                            </div>

                            {{-- Size badge + download button --}}
                            <div class="dl-meta">
                                @if($d->ukuran)
                                    <span class="dl-size-badge"><i class="bi bi-hdd me-1"></i>{{ $d->ukuran }}</span>
                                @endif
                                <a href="{{ route('download.unduh', $d->id) }}"
                                   class="btn-unduh"
                                   title="Unduh {{ $d->judul }}">
                                    <i class="bi bi-download"></i> Unduh
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Info note --}}
            <div class="mt-4 p-3 rounded-3 d-flex align-items-start gap-2" style="background:#fff8f9; border:1px solid #fde0e6;">
                <i class="bi bi-info-circle-fill text-danger mt-1" style="flex-shrink:0;"></i>
                <p class="mb-0 text-muted" style="font-size:0.82rem;">
                    Jika terdapat masalah saat mengunduh atau dokumen tidak dapat dibuka, silakan hubungi kami melalui
                    <a href="{{ route('kontak') }}" style="color:var(--red-primary); font-weight:600;">halaman kontak</a>.
                </p>
            </div>
        @endif

    </div>
</section>

@endsection
