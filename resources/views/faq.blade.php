@extends('layouts.app')
@section('title', 'FAQ – Pertanyaan Umum - ' . ($site['singkatan']?->value ?? 'PSMPD') . '-FEB UNTAG Semarang')
@section('og_title', 'FAQ – Pertanyaan Umum | ' . ($site['singkatan']?->value ?? 'PSMPD') . ' FEB UNTAG Semarang')
@section('og_description', 'Temukan jawaban atas pertanyaan umum seputar Program Studi ' . ($site['nama_prodi']?->value ?? 'Manajemen Program Doktor') . ' FEB UNTAG Semarang.')

@section('styles')
<style>
/* ── FAQ page ───────────────────────────────────────────────────────────── */

/* Category title */
.faq-category-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.faq-category-title::after {
    content: '';
    flex: 1;
    height: 2px;
    background: linear-gradient(to right, var(--red-primary), transparent);
    border-radius: 2px;
}
.faq-category-title i {
    color: var(--red-primary);
    font-size: 1rem;
    flex-shrink: 0;
}

/* Accordion overrides */
.faq-accordion .accordion-item {
    border: none;
    border-radius: 10px !important;
    margin-bottom: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    overflow: hidden;
    transition: box-shadow 0.2s;
}
.faq-accordion .accordion-item:hover {
    box-shadow: 0 4px 18px rgba(0,0,0,0.1);
}
.faq-accordion .accordion-button {
    font-family: 'Inter', sans-serif;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--dark);
    background: #fff;
    padding: 16px 20px;
    border-radius: 10px !important;
    box-shadow: none;
    border-left: 4px solid transparent;
    transition: color 0.2s, border-color 0.2s, background 0.2s;
}
.faq-accordion .accordion-button:not(.collapsed) {
    color: var(--red-primary);
    background: #fff8f9;
    border-left-color: var(--red-primary);
    border-radius: 10px 10px 0 0 !important;
}
.faq-accordion .accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23C0304A'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    flex-shrink: 0;
}
.faq-accordion .accordion-button.collapsed::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23555'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}
.faq-accordion .accordion-body {
    font-size: 0.875rem;
    line-height: 1.75;
    color: #444;
    background: #fff8f9;
    padding: 14px 20px 18px 24px;
    border-left: 4px solid var(--red-primary);
    border-radius: 0 0 10px 10px;
}

/* Empty state */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: var(--gray-text);
}
.empty-state i { font-size: 3.5rem; color: #ddd; display: block; margin-bottom: 16px; }

/* CTA card */
.faq-cta {
    background: linear-gradient(135deg, #fff 0%, #fff5f7 100%);
    border: 1.5px solid #fde0e6;
    border-radius: 14px;
    padding: 32px;
    text-align: center;
}
.faq-cta h4 {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 8px;
}
.faq-cta p {
    color: var(--gray-text);
    font-size: 0.875rem;
    margin-bottom: 20px;
    max-width: 420px;
    margin-left: auto;
    margin-right: auto;
}
</style>
@endsection

@section('content')

{{-- ── PAGE HERO ──────────────────────────────────────────────────────────── --}}
<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-patch-question me-2"></i>FAQ &ndash; Pertanyaan Umum</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">FAQ</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ── MAIN CONTENT ───────────────────────────────────────────────────────── --}}
<section class="py-5" style="background:#f8f9fa;">
    <div class="container-xl">

        @if($faqs->isEmpty())
            {{-- Empty state --}}
            <div class="empty-state">
                <i class="bi bi-question-circle"></i>
                <h5 style="font-weight:700; color:var(--dark);">Belum Ada FAQ</h5>
                <p class="text-muted" style="max-width:400px; margin:0 auto;">
                    Belum ada pertanyaan yang tersedia. Silakan hubungi kami jika Anda memiliki pertanyaan.
                </p>
                <a href="{{ route('kontak') }}" class="btn btn-primary mt-4">
                    <i class="bi bi-envelope me-2"></i>Hubungi Kami
                </a>
            </div>
        @else
            @php $accordionIndex = 0; @endphp

            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <div class="d-flex flex-column gap-5">
                        @foreach($faqs as $kategori => $items)
                        @php
                            $catLabel = ($kategori && trim($kategori) !== '') ? $kategori : 'Umum';
                            $catIcons = [
                                'Umum'         => 'bi-info-circle',
                                'Akademik'     => 'bi-mortarboard',
                                'Pendaftaran'  => 'bi-pencil-square',
                                'Administrasi' => 'bi-folder2',
                                'Keuangan'     => 'bi-cash-coin',
                                'Beasiswa'     => 'bi-award',
                                'Lainnya'      => 'bi-three-dots',
                            ];
                            $catIcon = $catIcons[$catLabel] ?? 'bi-chat-left-text';
                        @endphp

                        <div data-aos="fade-up">
                            {{-- Category heading --}}
                            <div class="faq-category-title">
                                <i class="bi {{ $catIcon }}"></i>
                                {{ $catLabel }}
                            </div>

                            {{-- Accordion --}}
                            <div class="accordion faq-accordion" id="faqAccordion{{ $loop->index }}">
                                @foreach($items as $faq)
                                @php
                                    $itemId   = 'faq-item-' . $accordionIndex;
                                    $headId   = 'faq-head-' . $accordionIndex;
                                    $collapseId = 'faq-collapse-' . $accordionIndex;
                                    // First item in first category open by default
                                    $isOpen = ($loop->parent->first && $loop->first);
                                    $accordionIndex++;
                                @endphp
                                <div class="accordion-item" id="{{ $itemId }}">
                                    <h2 class="accordion-header" id="{{ $headId }}">
                                        <button class="accordion-button {{ $isOpen ? '' : 'collapsed' }}"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#{{ $collapseId }}"
                                                aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                                                aria-controls="{{ $collapseId }}">
                                            {{ $faq->pertanyaan }}
                                        </button>
                                    </h2>
                                    <div id="{{ $collapseId }}"
                                         class="accordion-collapse collapse {{ $isOpen ? 'show' : '' }}"
                                         aria-labelledby="{{ $headId }}"
                                         data-bs-parent="#faqAccordion{{ $loop->parent->index }}">
                                        <div class="accordion-body">
                                            {!! nl2br(e($faq->jawaban)) !!}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- ── Call to Action ───────────────────────────────────────── --}}
                    <div class="faq-cta mt-5" data-aos="fade-up">
                        <i class="bi bi-headset" style="font-size:2.2rem; color:var(--red-primary); display:block; margin-bottom:12px;"></i>
                        <h4>Pertanyaan Anda belum terjawab?</h4>
                        <p>Tim kami siap membantu Anda. Kirimkan pertanyaan Anda langsung kepada kami dan kami akan merespons secepatnya.</p>
                        <a href="{{ route('kontak') }}" class="btn btn-primary">
                            <i class="bi bi-envelope me-2"></i>Hubungi Kami
                        </a>
                    </div>

                </div>
            </div>
        @endif

    </div>
</section>

@endsection
