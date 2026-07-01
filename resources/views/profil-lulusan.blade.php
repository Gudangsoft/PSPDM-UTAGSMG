@extends('layouts.app')
@section('title', 'Profil Lulusan - ' . ($site['singkatan']?->value ?? 'PSMPD'))
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-mortarboard me-2"></i>Profil Lulusan</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Profil Lulusan</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>2 Profil Lulusan Unggulan</h2>
            <p>Lulusan {{ $site['singkatan']?->value ?? 'PSMPD' }} – {{ $site['singkatan_institusi']?->value ?? 'FEB Untag Semarang' }} mampu berkiprah di berbagai sektor strategis pada level tertinggi</p>
        </div>

        @php
        $lulusans = [
            [
                'no' => '01', 'icon' => 'bi-person-badge-fill', 'color' => '#C0304A',
                'judul' => 'Pemimpin Profesional dan Penggerak Perubahan',
                'desc' => 'Lulusan mampu memimpin organisasi secara strategis, etis, dan adaptif baik di sektor swasta, publik maupun akademik dengan mengintegrasikan keahlian Manajemen Human Capital, Transformasi Bisnis (Marketing), Keuangan Berkelanjutan berbasis Research untuk mendorong pertumbuhan jangka panjang yang berdampak.',
                'kompetensi' => ['Kepemimpinan Strategis & Transformasional', 'Manajemen SDM & Talenta Global', 'Keuangan Etis & ESG Framework', 'Inovasi Bisnis & Analisis Ekosistem Pasar', 'Kebijakan Publik Berbasis Riset', 'Tata Kelola & Manajemen Risiko'],
            ],
            [
                'no' => '02', 'icon' => 'bi-journal-bookmark-fill', 'color' => '#6247aa',
                'judul' => 'Akademisi, Ilmuwan & Peneliti Manajemen',
                'desc' => 'Mampu menghasilkan karya ilmiah bereputasi internasional dan berkontribusi pada pengembangan ilmu manajemen Human Capital, Transformasi Bisnis (Marketing), dan Keuangan Berkelanjutan.',
                'kompetensi' => ['Riset Kuantitatif & Kualitatif', 'Publikasi Terindeks Scopus', 'Pengembangan Teori', 'Kolaborasi Riset Internasional'],
            ],
        ];
        @endphp

        <div class="row g-4">
            @foreach($lulusans as $l)
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="card border-0 rounded-4 shadow-sm h-100 overflow-hidden" style="border-left: 5px solid {{ $l['color'] }}!important;">
                    <div class="card-body p-4">
                        <div class="d-flex gap-3 mb-3">
                            <div style="width:56px; height:56px; background:{{ $l['color'] }}; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.5rem; color:white; flex-shrink:0;">
                                <i class="{{ $l['icon'] }}"></i>
                            </div>
                            <div>
                                <span style="font-size:2rem; font-weight:900; color:{{ $l['color'] }}; opacity:0.15; line-height:1; display:block; margin-bottom:-8px;">{{ $l['no'] }}</span>
                                <h5 style="font-size:1rem; font-weight:700; color:var(--dark);">{{ $l['judul'] }}</h5>
                            </div>
                        </div>
                        <p class="text-muted" style="font-size:0.875rem; line-height:1.75;">{{ $l['desc'] }}</p>
                        <h6 style="font-size:0.8rem; font-weight:700; color:{{ $l['color'] }}; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:8px;">Kompetensi Utama</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($l['kompetensi'] as $k)
                            <span class="badge rounded-pill" style="background:rgba(0,0,0,0.05); color:#444; font-size:0.75rem; font-weight:500; padding:5px 10px;">{{ $k }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
