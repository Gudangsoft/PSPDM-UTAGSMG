@extends('layouts.app')
@section('title', 'Konsentrasi Program Studi - PSMPD-FEB UNTAG')
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-diagram-3 me-2"></i>Konsentrasi Program Studi</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Konsentrasi</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>Tiga Konsentrasi Unggulan</h2>
            <p>Dirancang untuk menghasilkan doktor manajemen yang spesialis dan berkompeten di bidangnya</p>
        </div>

        {{-- Konsentrasi 1 --}}
        <div class="row g-5 align-items-center mb-5 pb-5 border-bottom" id="sdm">
            <div class="col-lg-5" data-aos="fade-right">
                <div style="background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); border-radius:20px; padding:50px; color:white; text-align:center;">
                    <div style="font-size:5rem; margin-bottom:20px;"><i class="bi bi-people-fill"></i></div>
                    <div style="font-size:3rem; font-weight:900; opacity:0.15; position:absolute; top:10px; right:20px;">01</div>
                    <h3 style="font-size:1.3rem; font-weight:700;">Manajemen Modal Manusia Strategis</h3>
                    <p style="opacity:0.85; font-size:0.875rem; margin-top:10px;">Human Capital Strategic Management</p>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <span class="badge mb-3" style="background:var(--red-primary); color:white; padding:6px 14px; border-radius:20px;">Konsentrasi 1</span>
                <h3 style="font-size:1.6rem; font-weight:700; color:var(--dark);">Manajemen Modal Manusia Strategis</h3>
                <p class="text-muted mt-3" style="line-height:1.8;">Mengkaji pengembangan, pengelolaan, dan optimalisasi sumber daya manusia secara strategis untuk meningkatkan kinerja organisasi dan daya saing institusi di era global.</p>
                <p class="text-muted" style="line-height:1.8;">Konsentrasi ini mempersiapkan mahasiswa untuk menjadi pemimpin SDM yang mampu mengelola modal manusia secara strategis, mengembangkan talenta, dan menciptakan budaya organisasi yang adaptif terhadap perubahan.</p>
                <h6 class="mt-4 mb-3" style="font-weight:700; color:var(--dark);">Topik Kajian Utama:</h6>
                <div class="row g-2">
                    @foreach(['Manajemen SDM Strategis', 'Pengembangan Organisasi', 'Kepemimpinan Transformasional', 'Manajemen Talenta', 'HR Analytics', 'Budaya & Perubahan Organisasi'] as $topik)
                    <div class="col-auto"><span class="badge" style="background:#fff5f5; color:var(--red-primary); border:1px solid #ffcccc; padding:6px 12px; border-radius:20px; font-size:0.78rem;">{{ $topik }}</span></div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Konsentrasi 2 --}}
        <div class="row g-5 align-items-center mb-5 pb-5 border-bottom flex-row-reverse" id="pasar">
            <div class="col-lg-5" data-aos="fade-left">
                <div style="background:linear-gradient(135deg,#1a1a2e,#16213e); border-radius:20px; padding:50px; color:white; text-align:center; position:relative; overflow:hidden;">
                    <div style="font-size:5rem; margin-bottom:20px;"><i class="bi bi-graph-up-arrow"></i></div>
                    <h3 style="font-size:1.3rem; font-weight:700;">Manajemen Ekosistem Pasar Inovatif</h3>
                    <p style="opacity:0.85; font-size:0.875rem; margin-top:10px;">Innovative Market Ecosystem Management</p>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge mb-3" style="background:var(--dark); color:white; padding:6px 14px; border-radius:20px;">Konsentrasi 2</span>
                <h3 style="font-size:1.6rem; font-weight:700; color:var(--dark);">Manajemen Ekosistem Pasar Inovatif</h3>
                <p class="text-muted mt-3" style="line-height:1.8;">Mempelajari dinamika pasar berbasis teknologi, transformasi bisnis, dan strategi pengelolaan ekosistem pasar yang inovatif, adaptif, dan kompetitif di tingkat nasional maupun internasional.</p>
                <p class="text-muted" style="line-height:1.8;">Mahasiswa akan dipersiapkan untuk memahami dan mengelola ekosistem pasar digital, mengembangkan strategi inovasi bisnis, dan memimpin transformasi organisasi di era industri 4.0.</p>
                <h6 class="mt-4 mb-3" style="font-weight:700; color:var(--dark);">Topik Kajian Utama:</h6>
                <div class="row g-2">
                    @foreach(['Pemasaran Digital', 'Inovasi Bisnis', 'Transformasi Digital', 'Manajemen Merek Global', 'Analitik Pasar', 'Strategi Kompetitif'] as $topik)
                    <div class="col-auto"><span class="badge" style="background:#f0f4ff; color:#1a1a2e; border:1px solid #c5d0e6; padding:6px 12px; border-radius:20px; font-size:0.78rem;">{{ $topik }}</span></div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Konsentrasi 3 --}}
        <div class="row g-5 align-items-center" id="keuangan">
            <div class="col-lg-5" data-aos="fade-right">
                <div style="background:linear-gradient(135deg,#c8a84b,#a0822a); border-radius:20px; padding:50px; color:white; text-align:center; position:relative; overflow:hidden;">
                    <div style="font-size:5rem; margin-bottom:20px;"><i class="bi bi-currency-exchange"></i></div>
                    <h3 style="font-size:1.3rem; font-weight:700;">Manajemen Keuangan Etis & Pengembangan Berkelanjutan</h3>
                    <p style="opacity:0.85; font-size:0.875rem; margin-top:10px;">Ethical Finance & Sustainable Development Management</p>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <span class="badge mb-3" style="background:#c8a84b; color:white; padding:6px 14px; border-radius:20px;">Konsentrasi 3</span>
                <h3 style="font-size:1.6rem; font-weight:700; color:var(--dark);">Manajemen Keuangan Etis & Pengembangan Berkelanjutan</h3>
                <p class="text-muted mt-3" style="line-height:1.8;">Mengintegrasikan prinsip etika, tata kelola keuangan yang bertanggung jawab, dan strategi pengembangan berkelanjutan untuk menciptakan nilai ekonomi yang berdampak sosial dan lingkungan positif.</p>
                <p class="text-muted" style="line-height:1.8;">Konsentrasi ini mempersiapkan pemimpin keuangan yang mampu mengelola aset secara etis, menerapkan prinsip ESG (Environmental, Social, Governance), dan merancang strategi keberlanjutan jangka panjang.</p>
                <h6 class="mt-4 mb-3" style="font-weight:700; color:var(--dark);">Topik Kajian Utama:</h6>
                <div class="row g-2">
                    @foreach(['Keuangan Berkelanjutan', 'ESG & Green Finance', 'Etika Bisnis', 'Tata Kelola Perusahaan', 'Manajemen Risiko', 'Corporate Governance'] as $topik)
                    <div class="col-auto"><span class="badge" style="background:#fffbf0; color:#a0822a; border:1px solid #e8d5a0; padding:6px 12px; border-radius:20px; font-size:0.78rem;">{{ $topik }}</span></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
