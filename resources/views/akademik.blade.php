@extends('layouts.app')
@section('title', 'Akademik - PSMPD-FEB UNTAG Semarang')
@section('content')

<div class="page-hero">
    <div class="container-xl">
        <h1><i class="bi bi-book me-2"></i>Akademik</h1>
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Akademik</li>
        </ol></nav>
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
            {{-- KURIKULUM --}}
            <div class="tab-pane fade show active" id="kurikulum">
                <h4 class="mb-4 text-center" style="font-weight:700;">Struktur Kurikulum Program Doktor Manajemen</h4>
                @php
                $matakuliah = [
                    ['semester' => 'Semester 1', 'matkul' => [
                        ['nama' => 'Filsafat Ilmu & Metodologi Penelitian', 'sks' => 3, 'jenis' => 'Wajib'],
                        ['nama' => 'Teori Organisasi & Manajemen Lanjutan', 'sks' => 3, 'jenis' => 'Wajib'],
                        ['nama' => 'Ekonomi Manajerial & Analisis Bisnis', 'sks' => 3, 'jenis' => 'Wajib'],
                    ]],
                    ['semester' => 'Semester 2', 'matkul' => [
                        ['nama' => 'Strategi Bisnis Berbasis Riset', 'sks' => 3, 'jenis' => 'Wajib'],
                        ['nama' => 'Seminar Penelitian Manajemen', 'sks' => 3, 'jenis' => 'Wajib'],
                        ['nama' => 'Mata Kuliah Konsentrasi I', 'sks' => 3, 'jenis' => 'Konsentrasi'],
                    ]],
                    ['semester' => 'Semester 3', 'matkul' => [
                        ['nama' => 'Mata Kuliah Konsentrasi II', 'sks' => 3, 'jenis' => 'Konsentrasi'],
                        ['nama' => 'Mata Kuliah Konsentrasi III', 'sks' => 3, 'jenis' => 'Konsentrasi'],
                        ['nama' => 'Proposal Disertasi', 'sks' => 6, 'jenis' => 'Penelitian'],
                    ]],
                    ['semester' => 'Semester 4-6', 'matkul' => [
                        ['nama' => 'Penelitian & Penulisan Disertasi', 'sks' => 12, 'jenis' => 'Disertasi'],
                        ['nama' => 'Publikasi Ilmiah Internasional', 'sks' => 3, 'jenis' => 'Wajib'],
                        ['nama' => 'Ujian Kualifikasi & Sidang Disertasi', 'sks' => 0, 'jenis' => 'Evaluasi'],
                    ]],
                ];
                @endphp
                <div class="row g-4">
                    @foreach($matakuliah as $sem)
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-header" style="background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); color:white; border-radius:16px 16px 0 0; padding:16px 20px;">
                                <h6 class="mb-0 fw-bold">{{ $sem['semester'] }}</h6>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                        @foreach($sem['matkul'] as $mk)
                                        <tr>
                                            <td style="font-size:0.875rem; padding:12px 20px;">{{ $mk['nama'] }}</td>
                                            <td class="text-center" style="font-size:0.8rem; font-weight:700; color:var(--red-primary); padding:12px;">{{ $mk['sks'] > 0 ? $mk['sks'].' SKS' : '-' }}</td>
                                            <td><span class="badge rounded-pill" style="font-size:0.72rem; background:{{ $mk['jenis']=='Wajib' ? '#fff5f5' : ($mk['jenis']=='Konsentrasi' ? '#f0f4ff' : ($mk['jenis']=='Penelitian' ? '#f0fff4' : '#fff8e1')) }}; color:{{ $mk['jenis']=='Wajib' ? 'var(--red-primary)' : ($mk['jenis']=='Konsentrasi' ? '#1a1a2e' : ($mk['jenis']=='Penelitian' ? '#2c7a4b' : '#c8a84b')) }};">{{ $mk['jenis'] }}</span></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="alert mt-4" style="background:#fff5f5; border:1px solid #ffcccc; border-radius:12px;">
                    <i class="bi bi-info-circle-fill text-danger me-2"></i>
                    <strong>Total:</strong> 42 SKS &bull; Durasi normal: 6 semester (3 tahun) &bull; Maksimal: 10 semester
                </div>
            </div>

            {{-- SYARAT PENDAFTARAN --}}
            <div class="tab-pane fade" id="syarat">
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header" style="background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); color:white; border-radius:16px 16px 0 0; padding:20px;">
                                <h5 class="mb-0 fw-bold"><i class="bi bi-person-check me-2"></i>Persyaratan Akademik</h5>
                            </div>
                            <div class="card-body p-4">
                                <ul class="list-unstyled" style="font-size:0.875rem; line-height:1.8;">
                                    @foreach(['Memiliki ijazah S2 (Magister) atau yang sederajat dari perguruan tinggi terakreditasi', 'IPK minimal 3.00 (skala 4.00)', 'Latar belakang pendidikan Manajemen/Ekonomi/Bisnis (atau bidang relevan)', 'Memiliki karya tulis ilmiah yang pernah dipublikasikan', 'Menguasai bahasa Inggris (TOEFL ≥ 500 atau IELTS ≥ 5.5)'] as $req)
                                    <li class="d-flex gap-2 mb-3">
                                        <i class="bi bi-check-circle-fill text-danger flex-shrink-0 mt-1"></i>
                                        {{ $req }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-header" style="background:var(--dark); color:white; border-radius:16px 16px 0 0; padding:20px;">
                                <h5 class="mb-0 fw-bold"><i class="bi bi-file-earmark-text me-2"></i>Dokumen yang Diperlukan</h5>
                            </div>
                            <div class="card-body p-4">
                                <ul class="list-unstyled" style="font-size:0.875rem; line-height:1.8;">
                                    @foreach(['Formulir pendaftaran (online)', 'Fotokopi ijazah S1 & S2 (dilegalisir)', 'Transkrip nilai S1 & S2 (dilegalisir)', 'Sertifikat TOEFL/IELTS (masih berlaku)', 'Proposal penelitian (±3000 kata)', 'Curriculum Vitae (CV) terbaru', 'Surat rekomendasi (2 orang)', 'Pas foto 3x4 (2 lembar)', 'Kartu Identitas (KTP/SIM)'] as $doc)
                                    <li class="d-flex gap-2 mb-2">
                                        <i class="bi bi-file-earmark-check text-danger flex-shrink-0 mt-1"></i>
                                        {{ $doc }}
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- JADWAL PMB --}}
            <div class="tab-pane fade" id="jadwal">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header" style="background:linear-gradient(135deg,var(--red-primary),var(--red-dark)); color:white; border-radius:16px 16px 0 0; padding:20px;">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-calendar-event me-2"></i>Jadwal Penerimaan Mahasiswa Baru {{ date('Y') }}/{{ date('Y')+1 }}</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead style="background:#f8f8f8;">
                                <tr><th style="padding:16px 20px;">Kegiatan</th><th style="padding:16px 20px;">Periode</th><th style="padding:16px 20px;">Keterangan</th></tr>
                            </thead>
                            <tbody style="font-size:0.875rem;">
                                <tr><td style="padding:14px 20px;"><strong>Pendaftaran Online Gelombang I</strong></td><td>Februari – April</td><td><span class="badge bg-success rounded-pill">Buka</span></td></tr>
                                <tr><td style="padding:14px 20px;"><strong>Seleksi Administrasi Gel. I</strong></td><td>April</td><td><span class="badge bg-secondary rounded-pill">Proses</span></td></tr>
                                <tr><td style="padding:14px 20px;"><strong>Tes Tulis & Wawancara Gel. I</strong></td><td>Mei</td><td><span class="badge bg-secondary rounded-pill">Proses</span></td></tr>
                                <tr><td style="padding:14px 20px;"><strong>Pengumuman Gel. I</strong></td><td>Juni</td><td><span class="badge bg-secondary rounded-pill">Belum</span></td></tr>
                                <tr><td style="padding:14px 20px;"><strong>Pendaftaran Online Gelombang II</strong></td><td>Juni – Agustus</td><td><span class="badge bg-warning text-dark rounded-pill">Akan Datang</span></td></tr>
                                <tr><td style="padding:14px 20px;"><strong>Awal Perkuliahan</strong></td><td>September</td><td><span class="badge bg-secondary rounded-pill">Belum</span></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('kontak') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-pencil-square me-2"></i>Hubungi untuk Informasi Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.nav-pills .nav-link { color: var(--dark); border-radius: 50px; margin: 0 4px; }
.nav-pills .nav-link.active { background: var(--red-primary); }
</style>
@endsection
