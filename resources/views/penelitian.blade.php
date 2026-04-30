@extends('layouts.app')
@section('title', 'Penelitian - PSMPD-FEB UNTAG Semarang')
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-journal-richtext me-2"></i>Penelitian</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Penelitian</li>
        </ol></nav>
    </div>
</div>

<section class="py-5">
    <div class="container-xl">
        <div class="section-title" data-aos="fade-up">
            <h2>Unggulan Riset</h2>
            <p>PSMPD-FEB UNTAG berkomitmen pada penelitian berkualitas tinggi yang berdampak bagi masyarakat</p>
        </div>

        <div class="row g-4 mb-5">
            @php $riset = [
                ['icon'=>'bi-people-fill','color'=>'#C0304A','judul'=>'Riset Modal Manusia','desc'=>'Penelitian mendalam tentang pengembangan kapasitas SDM, kepemimpinan, dan produktivitas organisasi.'],
                ['icon'=>'bi-graph-up-arrow','color'=>'#1a1a2e','judul'=>'Riset Ekosistem Pasar','desc'=>'Kajian transformasi digital, inovasi bisnis, dan dinamika pasar nasional & internasional.'],
                ['icon'=>'bi-currency-exchange','color'=>'#c8a84b','judul'=>'Riset Keuangan Etis','desc'=>'Penelitian tentang tata kelola keuangan, ESG, dan keberlanjutan ekonomi jangka panjang.'],
                ['icon'=>'bi-globe2','color'=>'#2c7a4b','judul'=>'Kerjasama Internasional','desc'=>'Kolaborasi riset dengan universitas dan lembaga penelitian mancanegara.'],
            ]; @endphp
            @foreach($riset as $r)
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                <div class="card border-0 shadow-sm rounded-4 h-100" style="border-left:4px solid {{ $r['color'] }}!important;">
                    <div class="card-body p-4 d-flex gap-3">
                        <div style="width:52px; height:52px; background:{{ $r['color'] }}; border-radius:12px; display:flex; align-items:center; justify-content:center; color:white; font-size:1.3rem; flex-shrink:0;">
                            <i class="{{ $r['icon'] }}"></i>
                        </div>
                        <div>
                            <h5 style="font-size:1rem; font-weight:700; color:var(--dark); margin-bottom:8px;">{{ $r['judul'] }}</h5>
                            <p class="text-muted mb-0" style="font-size:0.875rem; line-height:1.7;">{{ $r['desc'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center py-5" style="background:#f8f8f8; border-radius:20px;" data-aos="fade-up">
            <i class="bi bi-journal-richtext" style="font-size:4rem; color:#ddd;"></i>
            <h5 class="mt-3 text-muted">Database publikasi akan segera tersedia</h5>
            <p class="text-muted" style="font-size:0.875rem;">Kami sedang mempersiapkan direktori penelitian dan publikasi ilmiah dosen.</p>
            <a href="{{ route('kontak') }}" class="btn btn-outline-primary mt-2">Hubungi Kami untuk Kolaborasi</a>
        </div>
    </div>
</section>

@endsection
