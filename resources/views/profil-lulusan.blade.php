@extends('layouts.app')
@section('title', 'Profil Lulusan - PSMPD-FEB UNTAG Semarang')
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
            <h2>5 Profil Lulusan Unggulan</h2>
            <p>Lulusan PSMPD-FEB UNTAG mampu berkiprah di berbagai sektor strategis pada level tertinggi</p>
        </div>

        @php
        $lulusans = [
            [
                'no' => '01', 'icon' => 'bi-person-badge-fill', 'color' => '#C0304A',
                'judul' => 'Eksekutif Strategis & Pemimpin Modal Manusia',
                'desc' => 'Lulusan mampu memimpin pengembangan dan pengelolaan sumber daya manusia secara strategis di level puncak pada institusi nasional maupun multinasional.',
                'kompetensi' => ['Strategi SDM Level C-Suite', 'Kepemimpinan Transformasional', 'HR Analytics Lanjutan', 'Manajemen Talenta Global'],
            ],
            [
                'no' => '02', 'icon' => 'bi-graph-up-arrow', 'color' => '#1a1a2e',
                'judul' => 'Konsultan Transformasi Bisnis & Ekosistem Pasar',
                'desc' => 'Lulusan mampu merancang dan mengimplementasikan strategi pemasaran inovatif serta pengelolaan ekosistem pasar yang adaptif dan kompetitif.',
                'kompetensi' => ['Strategi Transformasi Digital', 'Analisis Ekosistem Pasar', 'Inovasi Bisnis', 'Manajemen Merek Global'],
            ],
            [
                'no' => '03', 'icon' => 'bi-currency-exchange', 'color' => '#c8a84b',
                'judul' => 'Pemimpin Keuangan Etis & Pengembangan Berkelanjutan',
                'desc' => 'Lulusan mampu mengelola keuangan organisasi secara etis, bertanggung jawab, dan berorientasi pada nilai pengembangan ekonomi jangka panjang.',
                'kompetensi' => ['Keuangan Berkelanjutan', 'ESG Framework', 'Tata Kelola Keuangan', 'Manajemen Risiko Strategis'],
            ],
            [
                'no' => '04', 'icon' => 'bi-building', 'color' => '#2c7a4b',
                'judul' => 'Pengambil Kebijakan & Pemimpin Sektor Publik',
                'desc' => 'Lulusan mampu merumuskan kebijakan strategis berbasis riset ilmiah di bidang SDM, pasar, dan keuangan untuk pembangunan nasional yang efektif.',
                'kompetensi' => ['Analisis Kebijakan Publik', 'Riset Berbasis Bukti', 'Manajemen Sektor Publik', 'Tata Kelola Pemerintahan'],
            ],
            [
                'no' => '05', 'icon' => 'bi-journal-bookmark-fill', 'color' => '#6247aa',
                'judul' => 'Akademisi, Ilmuwan & Peneliti Manajemen',
                'desc' => 'Lulusan mampu menghasilkan karya ilmiah bereputasi internasional dan berkontribusi nyata pada pengembangan ilmu manajemen SDM, pemasaran, dan keuangan.',
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
