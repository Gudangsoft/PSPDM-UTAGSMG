@extends('layouts.admin')
@section('title', 'Konten Beranda')
@section('page-title', 'Konten Beranda')

@php
$g = fn(string $key, string $default = '') => $settings[$key]?->value ?? $default;
@endphp

@section('styles')
<style>
.tab-section { display:none; }
.tab-section.active { display:block; }
.nav-beranda .nav-link { border-radius:8px; font-size:.82rem; font-weight:600; color:#666; padding:8px 14px; }
.nav-beranda .nav-link.active { background:var(--red); color:white; }
.nav-beranda .nav-link:hover:not(.active) { background:#f5f5f5; color:#333; }
.item-block { background:#f9f9f9; border:1px solid #eee; border-radius:12px; padding:20px; }
.item-block-header { font-weight:700; font-size:.85rem; color:#1a1a2e; margin-bottom:14px; display:flex; align-items:center; gap:8px; }
.icon-preview-inline { display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; background:#fff0f0; border-radius:8px; color:var(--red); font-size:1rem; flex-shrink:0; }
</style>
@endsection

@section('content')

<form action="{{ route('admin.beranda.update') }}" method="POST" enctype="multipart/form-data">
@csrf

{{-- Tab Nav --}}
<div class="admin-card card mb-4">
    <div class="card-body p-3">
        <ul class="nav nav-beranda gap-1 flex-wrap" id="berandaTabs">
            <li class="nav-item"><a class="nav-link active" href="#" data-tab="hero"><i class="bi bi-layout-text-sidebar-reverse me-1"></i>Hero</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="kartu"><i class="bi bi-card-checklist me-1"></i>Kartu Statistik</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="statsbar"><i class="bi bi-bar-chart me-1"></i>Bar Statistik</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="konsentrasi"><i class="bi bi-diagram-3 me-1"></i>Konsentrasi</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="keunggulan"><i class="bi bi-stars me-1"></i>Keunggulan</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="lulusan"><i class="bi bi-mortarboard me-1"></i>Profil Lulusan</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="beritagaleri"><i class="bi bi-newspaper me-1"></i>Berita & Galeri</a></li>
            <li class="nav-item"><a class="nav-link" href="#" data-tab="cta"><i class="bi bi-megaphone me-1"></i>Seksi CTA</a></li>
        </ul>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TAB 1: HERO --}}
{{-- ============================================================ --}}
<div class="tab-section active" id="tab-hero">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-layout-text-sidebar-reverse me-2"></i>Teks Hero</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Teks Badge (atas judul)</label>
                            <input type="text" name="hero_badge" class="form-control"
                                value="{{ $g('hero_badge', 'Terakreditasi Unggul') }}"
                                placeholder="Terakreditasi Unggul">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Judul Baris 1</label>
                            <input type="text" name="hero_judul_1" class="form-control"
                                value="{{ $g('hero_judul_1', 'Program Doktor') }}"
                                placeholder="Program Doktor">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kata Highlight <span class="text-warning fw-bold">★</span></label>
                            <input type="text" name="hero_judul_hl" class="form-control"
                                value="{{ $g('hero_judul_hl', 'Manajemen') }}"
                                placeholder="Manajemen">
                            <small class="text-muted">Tampil warna emas.</small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Judul Baris 2</label>
                            <input type="text" name="hero_judul_2" class="form-control"
                                value="{{ $g('hero_judul_2', 'Berbasis Nilai Pancasila') }}"
                                placeholder="Berbasis Nilai Pancasila">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi / Sub-judul</label>
                            <textarea name="hero_deskripsi" rows="3" class="form-control"
                                placeholder="Deskripsi singkat program studi...">{{ $g('hero_deskripsi', 'Hadir sebagai pusat unggulan riset dan pengembangan teori manajemen, berorientasi pada transformasi strategis untuk melahirkan pemikir manajemen Indonesia yang orisinal, inovatif, dan berdaya saing global.') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card card">
                <div class="card-header"><i class="bi bi-cursor me-2"></i>Tombol Hero</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Tombol 1 – Label</label>
                            <input type="text" name="hero_btn1_label" class="form-control"
                                value="{{ $g('hero_btn1_label', 'Daftar Sekarang') }}">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Tombol 1 – URL</label>
                            <input type="text" name="hero_btn1_url" class="form-control"
                                value="{{ $g('hero_btn1_url', '') }}"
                                placeholder="https://... atau /akademik (kosong = halaman Akademik)">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tombol 2 – Label</label>
                            <input type="text" name="hero_btn2_label" class="form-control"
                                value="{{ $g('hero_btn2_label', 'Pelajari Lebih Lanjut') }}">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Tombol 2 – URL</label>
                            <input type="text" name="hero_btn2_url" class="form-control"
                                value="{{ $g('hero_btn2_url', '') }}"
                                placeholder="https://... atau /tentang (kosong = halaman Tentang)">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            {{-- Gambar Hero --}}
            @php $heroGambar = $settings['hero_gambar']?->value ?? ''; @endphp
            <div class="admin-card card">
                <div class="card-header"><i class="bi bi-image me-2"></i>Gambar Hero</div>
                <div class="card-body p-4">
                    @if($heroGambar)
                    <div class="mb-3">
                        <img src="{{ asset('storage/'.$heroGambar) }}" alt="Gambar Hero"
                             class="img-fluid rounded-3 w-100"
                             style="max-height:200px; object-fit:cover; box-shadow:0 4px 15px rgba(0,0,0,0.1);">
                        <div class="mt-2">
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-2"
                                    onclick="hapusHeroGambar('{{ route('admin.beranda.destroyHeroGambar') }}')">
                                <i class="bi bi-trash me-1"></i>Hapus Gambar
                            </button>
                        </div>
                    </div>
                    @endif

                    <div>
                        <label class="form-label fw-semibold" style="font-size:.85rem;">
                            {{ $heroGambar ? 'Ganti Gambar' : 'Upload Gambar' }}
                        </label>
                        <input type="file" name="hero_gambar" id="heroGambarInput"
                               class="form-control" accept="image/jpeg,image/png,image/webp">
                        <small class="text-muted d-block mt-1">JPG / PNG / WebP · Maks 3 MB.<br>Ditampilkan di sisi kanan hero beranda.</small>
                    </div>

                    <div id="heroGambarPreview" class="mt-3" style="display:none;">
                        <p class="text-muted mb-1" style="font-size:.78rem;"><i class="bi bi-eye me-1"></i>Pratinjau:</p>
                        <img id="heroGambarPreviewImg" src="" alt=""
                             class="img-fluid rounded-3 w-100"
                             style="max-height:180px; object-fit:cover;">
                    </div>
                </div>
            </div>

            {{-- Slider Background --}}
            <div class="admin-card card mt-4">
                <div class="card-header"><i class="bi bi-images me-2"></i>Slider Background Hero</div>
                <div class="card-body p-4">
                    <p class="text-muted mb-3" style="font-size:.78rem;"><i class="bi bi-info-circle me-1"></i>Upload hingga 5 gambar. Gambar akan berganti otomatis setiap 5 detik. Kosongkan semua slot untuk kembali ke background merah.</p>
                    @for($si = 1; $si <= 5; $si++)
                    @php $sliderVal = $settings["hero_slider_$si"]?->value ?? ''; @endphp
                    <div class="mb-3 p-3 rounded-3" style="background:#f9f9f9;border:1px solid #eee;">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="fw-bold" style="font-size:.8rem;color:#444;">Gambar {{ $si }}</span>
                            @if($sliderVal)
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-2 py-0 px-2 ms-auto"
                                    onclick="hapusSlider({{ $si }},'{{ route('admin.beranda.destroySlider', $si) }}')"
                                    style="font-size:.72rem;">
                                <i class="bi bi-trash me-1"></i>Hapus
                            </button>
                            @endif
                        </div>
                        @if($sliderVal)
                        <img src="{{ asset('storage/'.$sliderVal) }}" class="img-fluid rounded-2 w-100 mb-2"
                             style="height:80px;object-fit:cover;">
                        @endif
                        <input type="file" name="hero_slider_{{ $si }}" class="form-control form-control-sm"
                               accept="image/jpeg,image/png,image/webp">
                    </div>
                    @endfor
                    <small class="text-muted">JPG/PNG/WEBP · Maks 3 MB per gambar. Rasio 16:9 direkomendasikan.</small>
                </div>
            </div>

            {{-- Struktur Hero mini --}}
            <div class="admin-card card mt-3">
                <div class="card-body p-3">
                    <p class="fw-bold mb-2" style="font-size:.8rem; color:#888;"><i class="bi bi-info-circle me-1"></i>Ilustrasi struktur hero</p>
                    <div style="background:linear-gradient(130deg,#7A1020,#C0304A,#D86070);border-radius:10px;padding:16px;color:white;font-size:.72rem;line-height:1.6;">
                        <div style="background:rgba(255,255,255,.15);border-radius:20px;padding:3px 10px;display:inline-block;margin-bottom:6px;">⭐ Badge</div><br>
                        <strong><em>Judul 1</em> <span style="color:#FFD700;">Highlight</span><br><em>Judul 2</em></strong>
                        <p style="margin:6px 0 10px;opacity:.8;font-size:.68rem;">Deskripsi...</p>
                        <div style="display:flex;gap:6px;">
                            <span style="background:white;color:#C0304A;padding:4px 10px;border-radius:5px;font-size:.65rem;font-weight:700;">Tombol 1</span>
                            <span style="border:1px solid white;padding:4px 10px;border-radius:5px;font-size:.65rem;">Tombol 2</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TAB 2: KARTU STATISTIK --}}
{{-- ============================================================ --}}
<div class="tab-section" id="tab-kartu">
    <div class="row g-4">
        {{-- 3 Stats --}}
        <div class="col-12">
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-123 me-2"></i>Angka Statistik (3 kolom)</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        @foreach([1,2,3] as $i)
                        @php
                            $defaults = [1=>['3','Konsentrasi'],2=>['6','Semester'],3=>['180+','Alumni']];
                        @endphp
                        <div class="col-md-4">
                            <div class="item-block">
                                <div class="item-block-header">Statistik {{ $i }}</div>
                                <div class="mb-2">
                                    <label class="form-label" style="font-size:.8rem;">Angka</label>
                                    <input type="text" name="hero_stat{{ $i }}_angka" class="form-control form-control-sm"
                                        value="{{ $g('hero_stat'.$i.'_angka', $defaults[$i][0]) }}" placeholder="{{ $defaults[$i][0] }}">
                                </div>
                                <div>
                                    <label class="form-label" style="font-size:.8rem;">Label</label>
                                    <input type="text" name="hero_stat{{ $i }}_label" class="form-control form-control-sm"
                                        value="{{ $g('hero_stat'.$i.'_label', $defaults[$i][1]) }}" placeholder="{{ $defaults[$i][1] }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Akreditasi --}}
        <div class="col-md-6">
            <div class="admin-card card h-100">
                <div class="card-header"><i class="bi bi-award me-2"></i>Kotak Akreditasi</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Akreditasi</label>
                            <input type="text" name="hero_akreditasi_nama" class="form-control"
                                value="{{ $g('hero_akreditasi_nama', 'Akreditasi Unggul') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Lembaga Akreditasi</label>
                            <input type="text" name="hero_akreditasi_badan" class="form-control"
                                value="{{ $g('hero_akreditasi_badan', 'BAN-PT – Kemenristekdikti') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nomor SK</label>
                            <input type="text" name="hero_sk_nomor" class="form-control"
                                value="{{ $g('hero_sk_nomor', 'SK No. 123') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Masa Berlaku</label>
                            <input type="text" name="hero_sk_valid" class="form-control"
                                value="{{ $g('hero_sk_valid', 'Valid 2024–2029') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- PMB Row --}}
        <div class="col-md-6">
            <div class="admin-card card h-100">
                <div class="card-header"><i class="bi bi-calendar-check me-2"></i>Baris Penerimaan (PMB)</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Label Teks</label>
                            <input type="text" name="hero_pmb_label" class="form-control"
                                value="{{ $g('hero_pmb_label', 'Penerimaan Mahasiswa Baru') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teks Tombol</label>
                            <input type="text" name="hero_pmb_btn" class="form-control"
                                value="{{ $g('hero_pmb_btn', 'Lihat Jadwal') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">URL Tombol</label>
                            <input type="text" name="hero_pmb_url" class="form-control"
                                value="{{ $g('hero_pmb_url', '') }}"
                                placeholder="kosong = Akademik">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TAB 3: BAR STATISTIK --}}
{{-- ============================================================ --}}
<div class="tab-section" id="tab-statsbar">
    <div class="admin-card card">
        <div class="card-header"><i class="bi bi-bar-chart me-2"></i>4 Item Statistik (Bar bawah hero)</div>
        <div class="card-body p-4">
            <div class="row g-4">
                @php
                $statsDefault = [
                    1 => ['bi-award',            'A',    'Akreditasi BAN-PT'],
                    2 => ['bi-people',            '20+',  'Dosen Berkualifikasi S3'],
                    3 => ['bi-journal-richtext',  '150+', 'Publikasi Internasional'],
                    4 => ['bi-globe2',            '10+',  'Mitra Internasional'],
                ];
                @endphp
                @foreach([1,2,3,4] as $i)
                <div class="col-md-6 col-lg-3">
                    <div class="item-block">
                        <div class="item-block-header">
                            <span class="icon-preview-inline" id="stats-icon-preview-{{ $i }}">
                                <i class="bi {{ $g('stats_'.$i.'_icon', $statsDefault[$i][0]) }}"></i>
                            </span>
                            Item {{ $i }}
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:.8rem;">Icon (Bootstrap Icons)</label>
                            <input type="text" name="stats_{{ $i }}_icon" class="form-control form-control-sm stats-icon-input"
                                data-target="{{ $i }}"
                                value="{{ $g('stats_'.$i.'_icon', $statsDefault[$i][0]) }}"
                                placeholder="{{ $statsDefault[$i][0] }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:.8rem;">Nilai / Angka</label>
                            <input type="text" name="stats_{{ $i }}_nilai" class="form-control form-control-sm"
                                value="{{ $g('stats_'.$i.'_nilai', $statsDefault[$i][1]) }}"
                                placeholder="{{ $statsDefault[$i][1] }}">
                        </div>
                        <div>
                            <label class="form-label" style="font-size:.8rem;">Deskripsi</label>
                            <input type="text" name="stats_{{ $i }}_desc" class="form-control form-control-sm"
                                value="{{ $g('stats_'.$i.'_desc', $statsDefault[$i][2]) }}"
                                placeholder="{{ $statsDefault[$i][2] }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TAB 4: KONSENTRASI --}}
{{-- ============================================================ --}}
<div class="tab-section" id="tab-konsentrasi">
    <div class="admin-card card mb-4">
        <div class="card-header"><i class="bi bi-type-h2 me-2"></i>Judul & Deskripsi Seksi Konsentrasi</div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">Judul Seksi</label>
                    <input type="text" name="kons_section_judul" class="form-control"
                        value="{{ $g('kons_section_judul', 'Konsentrasi Program Studi') }}">
                </div>
                <div class="col-md-7">
                    <label class="form-label">Deskripsi Seksi</label>
                    <input type="text" name="kons_section_desc" class="form-control"
                        value="{{ $g('kons_section_desc', 'Tiga bidang unggulan yang dirancang untuk melahirkan pemimpin dan inovator manajemen tingkat doktoral') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="admin-card card">
        <div class="card-header"><i class="bi bi-diagram-3 me-2"></i>3 Kartu Konsentrasi Program Studi</div>
        <div class="card-body p-4">
            @php
            $konsDefault = [
                1 => ['bi-people-fill', 'Manajemen Modal Manusia Strategis', 'Mengkaji pengembangan, pengelolaan, dan optimalisasi sumber daya manusia secara strategis untuk meningkatkan kinerja organisasi dan daya saing institusi di era global.'],
                2 => ['bi-graph-up-arrow', 'Manajemen Ekosistem Pasar Inovatif', 'Mempelajari dinamika pasar berbasis teknologi, transformasi bisnis, dan strategi pengelolaan ekosistem pasar yang inovatif, adaptif, dan kompetitif di tingkat nasional maupun internasional.'],
                3 => ['bi-currency-exchange', 'Manajemen Keuangan Etis & Pengembangan Berkelanjutan', 'Mengintegrasikan prinsip etika, tata kelola keuangan yang bertanggung jawab, dan strategi pengembangan berkelanjutan untuk menciptakan nilai ekonomi yang berdampak sosial dan lingkungan positif.'],
            ];
            @endphp
            <div class="row g-4">
                @foreach([1,2,3] as $i)
                <div class="col-lg-4">
                    <div class="item-block">
                        <div class="item-block-header">
                            <span class="icon-preview-inline" id="kons-icon-preview-{{ $i }}">
                                <i class="bi {{ $g('kons_'.$i.'_icon', $konsDefault[$i][0]) }}"></i>
                            </span>
                            Konsentrasi {{ $i }}
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:.8rem;">Icon</label>
                            <input type="text" name="kons_{{ $i }}_icon" class="form-control form-control-sm kons-icon-input"
                                data-target="{{ $i }}"
                                value="{{ $g('kons_'.$i.'_icon', $konsDefault[$i][0]) }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:.8rem;">Judul</label>
                            <input type="text" name="kons_{{ $i }}_judul" class="form-control form-control-sm"
                                value="{{ $g('kons_'.$i.'_judul', $konsDefault[$i][1]) }}">
                        </div>
                        <div>
                            <label class="form-label" style="font-size:.8rem;">Deskripsi</label>
                            <textarea name="kons_{{ $i }}_deskripsi" rows="3" class="form-control form-control-sm">{{ $g('kons_'.$i.'_deskripsi', $konsDefault[$i][2]) }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TAB 5: KEUNGGULAN --}}
{{-- ============================================================ --}}
<div class="tab-section" id="tab-keunggulan">
    <div class="admin-card card mb-4">
        <div class="card-header"><i class="bi bi-type-h2 me-2"></i>Judul & Deskripsi Seksi Keunggulan</div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">Judul Seksi</label>
                    <input type="text" name="unggul_section_judul" class="form-control"
                        value="{{ $g('unggul_section_judul', 'Keunggulan PSMPD-FEB UNTAG') }}">
                </div>
                <div class="col-md-7">
                    <label class="form-label">Deskripsi Seksi</label>
                    <input type="text" name="unggul_section_desc" class="form-control"
                        value="{{ $g('unggul_section_desc', 'Pusat unggulan riset dan pengembangan teori manajemen berbasis nilai-nilai Pancasila') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="admin-card card">
        <div class="card-header"><i class="bi bi-stars me-2"></i>6 Item Keunggulan</div>
        <div class="card-body p-4">
            @php
            $unggulDefault = [
                1 => ['bi-award-fill',         'Terakreditasi Unggul',   'Akreditasi tertinggi BAN-PT menjamin kualitas pendidikan'],
                2 => ['bi-mortarboard-fill',    'Dosen Guru Besar',       'Dibimbing oleh professor dan doktor berpengalaman'],
                3 => ['bi-journal-check',       'Riset Bereputasi',       'Publikasi terindeks Scopus dan WoS'],
                4 => ['bi-globe-americas',      'Jaringan Global',        'Kolaborasi riset internasional dan pertukaran akademisi'],
                5 => ['bi-shield-check',        'Berbasis Pancasila',     'Mengintegrasikan nilai-nilai Pancasila dalam kurikulum'],
                6 => ['bi-lightning-charge-fill','Kurikulum Inovatif',    'Kurikulum adaptif sesuai kebutuhan industri dan riset'],
            ];
            @endphp
            <div class="row g-3">
                @foreach([1,2,3,4,5,6] as $i)
                <div class="col-md-6 col-lg-4">
                    <div class="item-block">
                        <div class="item-block-header">
                            <span class="icon-preview-inline" id="unggul-icon-preview-{{ $i }}">
                                <i class="bi {{ $g('unggul_'.$i.'_icon', $unggulDefault[$i][0]) }}"></i>
                            </span>
                            Keunggulan {{ $i }}
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:.8rem;">Icon</label>
                            <input type="text" name="unggul_{{ $i }}_icon" class="form-control form-control-sm unggul-icon-input"
                                data-target="{{ $i }}"
                                value="{{ $g('unggul_'.$i.'_icon', $unggulDefault[$i][0]) }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:.8rem;">Judul</label>
                            <input type="text" name="unggul_{{ $i }}_judul" class="form-control form-control-sm"
                                value="{{ $g('unggul_'.$i.'_judul', $unggulDefault[$i][1]) }}">
                        </div>
                        <div>
                            <label class="form-label" style="font-size:.8rem;">Deskripsi</label>
                            <input type="text" name="unggul_{{ $i }}_deskripsi" class="form-control form-control-sm"
                                value="{{ $g('unggul_'.$i.'_deskripsi', $unggulDefault[$i][2]) }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TAB 6: PROFIL LULUSAN --}}
{{-- ============================================================ --}}
<div class="tab-section" id="tab-lulusan">
    <div class="admin-card card mb-4">
        <div class="card-header"><i class="bi bi-type-h2 me-2"></i>Judul & Deskripsi Seksi Profil Lulusan</div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Judul Seksi</label>
                    <input type="text" name="lulusan_section_judul" class="form-control"
                        value="{{ $g('lulusan_section_judul', 'Profil Lulusan') }}">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Deskripsi Seksi</label>
                    <input type="text" name="lulusan_section_desc" class="form-control"
                        value="{{ $g('lulusan_section_desc', 'Lulusan PSMPD-FEB UNTAG siap memimpin di berbagai sektor strategis nasional maupun internasional') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="admin-card card">
        <div class="card-header"><i class="bi bi-mortarboard me-2"></i>5 Profil Lulusan</div>
        <div class="card-body p-4">
            @php
            $lulusanDefault = [
                1 => ['Eksekutif Strategis & Pemimpin Modal Manusia', 'Mampu memimpin pengembangan SDM secara strategis di level puncak pada institusi nasional maupun multinasional.'],
                2 => ['Konsultan Transformasi Bisnis & Ekosistem Pasar', 'Mampu merancang dan mengimplementasikan strategi pemasaran inovatif serta pengelolaan ekosistem pasar yang adaptif.'],
                3 => ['Pemimpin Keuangan Etis & Pengembangan Berkelanjutan', 'Mampu mengelola keuangan organisasi secara etis, bertanggung jawab, dan berorientasi pada nilai jangka panjang.'],
                4 => ['Pengambil Kebijakan & Pemimpin Sektor Publik', 'Mampu merumuskan kebijakan strategis berbasis riset di bidang SDM, pasar, dan keuangan untuk pembangunan nasional.'],
                5 => ['Akademisi, Ilmuwan & Peneliti Manajemen', 'Mampu menghasilkan karya ilmiah bereputasi internasional dan berkontribusi pada pengembangan ilmu manajemen.'],
            ];
            @endphp
            <div class="row g-3">
                @foreach([1,2,3,4,5] as $i)
                <div class="col-md-6">
                    <div class="item-block">
                        <div class="item-block-header">
                            <span style="width:28px;height:28px;background:var(--red);color:white;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:800;flex-shrink:0;">{{ $i }}</span>
                            Lulusan {{ $i }}
                        </div>
                        <div class="mb-2">
                            <label class="form-label" style="font-size:.8rem;">Judul / Peran</label>
                            <input type="text" name="lulusan_{{ $i }}_judul" class="form-control form-control-sm"
                                value="{{ $g('lulusan_'.$i.'_judul', $lulusanDefault[$i][0]) }}">
                        </div>
                        <div>
                            <label class="form-label" style="font-size:.8rem;">Deskripsi</label>
                            <textarea name="lulusan_{{ $i }}_deskripsi" rows="2" class="form-control form-control-sm">{{ $g('lulusan_'.$i.'_deskripsi', $lulusanDefault[$i][1]) }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TAB 7b: BERITA & GALERI --}}
{{-- ============================================================ --}}
<div class="tab-section" id="tab-beritagaleri">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="admin-card card h-100">
                <div class="card-header"><i class="bi bi-newspaper me-2"></i>Judul & Deskripsi Seksi Berita</div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Judul Seksi</label>
                        <input type="text" name="berita_section_judul" class="form-control"
                            value="{{ $g('berita_section_judul', 'Berita Terbaru') }}">
                    </div>
                    <div>
                        <label class="form-label">Deskripsi Seksi</label>
                        <input type="text" name="berita_section_desc" class="form-control"
                            value="{{ $g('berita_section_desc', 'Informasi terkini dari PSMPD-FEB UNTAG Semarang') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="admin-card card h-100">
                <div class="card-header"><i class="bi bi-images me-2"></i>Judul & Deskripsi Seksi Galeri</div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Judul Seksi</label>
                        <input type="text" name="galeri_section_judul" class="form-control"
                            value="{{ $g('galeri_section_judul', 'Galeri Kegiatan') }}">
                    </div>
                    <div>
                        <label class="form-label">Deskripsi Seksi</label>
                        <input type="text" name="galeri_section_desc" class="form-control"
                            value="{{ $g('galeri_section_desc', 'Momen berharga dalam perjalanan akademik PSMPD-FEB UNTAG') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- TAB 7: CTA SECTION --}}
{{-- ============================================================ --}}
<div class="tab-section" id="tab-cta">
    <div class="admin-card card">
        <div class="card-header"><i class="bi bi-megaphone me-2"></i>Seksi CTA (Bagian Bawah Beranda)</div>
        <div class="card-body p-4">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label">Judul CTA</label>
                    <input type="text" name="cta_section_judul" class="form-control"
                        value="{{ $g('cta_section_judul', 'Siap Melangkah ke Jenjang Doktoral?') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Teks / Deskripsi</label>
                    <textarea name="cta_section_teks" rows="3" class="form-control">{{ $g('cta_section_teks', 'Bergabunglah bersama para pemimpin, akademisi, dan profesional terbaik Indonesia. Wujudkan impian Anda menjadi doktor manajemen yang berpengaruh.') }}</textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tombol 1 – Label</label>
                    <input type="text" name="cta_section_btn1_label" class="form-control"
                        value="{{ $g('cta_section_btn1_label', 'Daftar Sekarang') }}">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Tombol 1 – URL</label>
                    <input type="text" name="cta_section_btn1_url" class="form-control"
                        value="{{ $g('cta_section_btn1_url', '') }}"
                        placeholder="kosong = halaman Akademik">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tombol 2 – Label</label>
                    <input type="text" name="cta_section_btn2_label" class="form-control"
                        value="{{ $g('cta_section_btn2_label', 'Hubungi Kami') }}">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Tombol 2 – URL</label>
                    <input type="text" name="cta_section_btn2_url" class="form-control"
                        value="{{ $g('cta_section_btn2_url', '') }}"
                        placeholder="kosong = halaman Kontak">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Save Bar --}}
<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary">
        <i class="bi bi-box-arrow-up-right me-1"></i>Lihat Website
    </a>
    <button type="submit" class="btn btn-admin-primary px-4">
        <i class="bi bi-save me-2"></i>Simpan Semua Perubahan
    </button>
</div>

</form>
@endsection

@section('scripts')
<script>
// Submit POST form via JS — menghindari nested form
function _submitPost(url, msg) {
    if (!confirm(msg)) return;
    const f = document.createElement('form');
    f.method = 'POST';
    f.action = url;
    f.innerHTML = '<input name="_token" value="{{ csrf_token() }}">';
    document.body.appendChild(f);
    f.submit();
}
function hapusHeroGambar(url) { _submitPost(url, 'Hapus gambar hero ini?'); }
function hapusSlider(num, url) { _submitPost(url, 'Hapus gambar slider ' + num + '?'); }

// Tab switching
document.querySelectorAll('#berandaTabs .nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('#berandaTabs .nav-link').forEach(l => l.classList.remove('active'));
        document.querySelectorAll('.tab-section').forEach(s => s.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('tab-' + this.dataset.tab).classList.add('active');
    });
});

// Live icon preview helpers
function makeIconPreview(inputClass, previewIdPrefix) {
    document.querySelectorAll('.' + inputClass).forEach(input => {
        input.addEventListener('input', function() {
            const preview = document.getElementById(previewIdPrefix + this.dataset.target);
            if (preview) preview.innerHTML = '<i class="bi ' + (this.value || 'bi-question') + '"></i>';
        });
    });
}
makeIconPreview('stats-icon-input',  'stats-icon-preview-');
makeIconPreview('kons-icon-input',   'kons-icon-preview-');
makeIconPreview('unggul-icon-input', 'unggul-icon-preview-');

// Live preview for hero image upload
document.getElementById('heroGambarInput').addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('heroGambarPreviewImg').src = e.target.result;
            document.getElementById('heroGambarPreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('heroGambarPreview').style.display = 'none';
    }
});
</script>
@endsection
