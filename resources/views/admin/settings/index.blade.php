@extends('layouts.admin')
@section('title', 'Pengaturan Website')
@section('page-title', 'Pengaturan Website')
@section('content')

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">

            {{-- Informasi Program Studi --}}
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-info-circle me-2"></i>Informasi Program Studi</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Nama Program Studi <span class="text-danger">*</span></label>
                            <input type="text" name="nama_prodi" class="form-control" value="{{ $settings['nama_prodi']->value ?? 'Program Studi Manajemen Program Doktor' }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Singkatan <span class="text-danger">*</span></label>
                            <input type="text" name="singkatan" class="form-control" value="{{ $settings['singkatan']->value ?? 'PSMPD' }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi Singkat</label>
                            <textarea name="deskripsi_singkat" rows="3" class="form-control" placeholder="Deskripsi singkat program studi untuk meta description dan footer website...">{{ $settings['deskripsi_singkat']->value ?? '' }}</textarea>
                            <small class="text-muted">Tampil di footer website dan meta description halaman.</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" rows="2" class="form-control" required>{{ $settings['alamat']->value ?? 'Jl. Pawiyatan Luhur IV No.1, Bendan Dhuwur, Semarang 50233' }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label"><i class="bi bi-map me-1 text-danger"></i>Google Maps Embed URL</label>
                            <textarea name="maps_embed" rows="3" class="form-control" placeholder="https://www.google.com/maps/embed?pb=...">{{ $settings['maps_embed']?->value ?? '' }}</textarea>
                            <small class="text-muted">
                                Cara mendapatkan URL: Google Maps → cari lokasi → klik <strong>Bagikan</strong> → tab <strong>Sematkan peta</strong> → salin nilai atribut <code>src="..."</code> dari kode iframe.
                            </small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="telepon" class="form-control" value="{{ $settings['telepon']->value ?? '(024) 8316405' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ $settings['email']->value ?? 'psmpd@untag-smg.ac.id' }}" required>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Visi & Misi --}}
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-eye me-2"></i>Visi & Misi</div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Visi <span class="text-danger">*</span></label>
                        <textarea name="visi" rows="3" class="form-control" required>{{ $settings['visi']->value ?? 'Menjadi Program Studi Manajemen Doktor yang unggul, inovatif, dan berdaya saing global.' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Misi <span class="text-danger">*</span></label>
                        <textarea name="misi" rows="5" class="form-control" placeholder="Gunakan baris baru untuk setiap misi..." required>{{ $settings['misi']->value ?? '' }}</textarea>
                        <small class="text-muted">Pisahkan setiap poin misi dengan baris baru.</small>
                    </div>

                    <hr class="my-3">
                    <p class="fw-semibold mb-3" style="font-size:.85rem; color:#444;"><i class="bi bi-info-circle me-1 text-danger"></i>Info Singkat Program Studi (ditampilkan di halaman Tentang)</p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Akreditasi</label>
                            <input type="text" name="info_akreditasi" class="form-control"
                                value="{{ $settings['info_akreditasi']?->value ?? 'Unggul (A)' }}"
                                placeholder="Unggul (A)">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Durasi Studi</label>
                            <input type="text" name="info_durasi" class="form-control"
                                value="{{ $settings['info_durasi']?->value ?? '6 Semester' }}"
                                placeholder="6 Semester">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Total SKS</label>
                            <input type="text" name="info_sks" class="form-control"
                                value="{{ $settings['info_sks']?->value ?? '42 SKS' }}"
                                placeholder="42 SKS">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tombol CTA --}}
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-cursor-fill me-2"></i>Tombol CTA Navbar (Daftar Sekarang)</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="cta_aktif" value="1" id="cta_aktif"
                                    {{ ($settings['cta_aktif']->value ?? '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="cta_aktif">Tampilkan tombol CTA di navbar</label>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Teks Tombol</label>
                            <input type="text" name="cta_label" class="form-control"
                                value="{{ $settings['cta_label']->value ?? 'Daftar Sekarang' }}"
                                placeholder="Daftar Sekarang">
                            <small class="text-muted">Label yang tampil di tombol navbar.</small>
                        </div>
                        <div class="col-md-7">
                            <label class="form-label">URL / Link Tombol</label>
                            <input type="text" name="cta_url" class="form-control"
                                value="{{ $settings['cta_url']->value ?? '' }}"
                                placeholder="https://... atau /akademik atau nama-route">
                            <small class="text-muted">Kosongkan untuk default ke halaman Akademik.</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Media Sosial --}}
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-share me-2"></i>Media Sosial & Kontak Digital</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-facebook me-1 text-primary"></i>Facebook URL</label>
                            <input type="text" name="facebook" class="form-control" value="{{ $settings['facebook']->value ?? '' }}" placeholder="https://facebook.com/...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-instagram me-1" style="color:#e1306c"></i>Instagram URL</label>
                            <input type="text" name="instagram" class="form-control" value="{{ $settings['instagram']->value ?? '' }}" placeholder="https://instagram.com/...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-youtube me-1 text-danger"></i>YouTube URL</label>
                            <input type="text" name="youtube" class="form-control" value="{{ $settings['youtube']->value ?? '' }}" placeholder="https://youtube.com/...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-twitter-x me-1"></i>Twitter / X URL</label>
                            <input type="text" name="twitter" class="form-control" value="{{ $settings['twitter']->value ?? '' }}" placeholder="https://twitter.com/...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="bi bi-whatsapp me-1 text-success"></i>WhatsApp</label>
                            <input type="text" name="whatsapp" class="form-control" value="{{ $settings['whatsapp']->value ?? '' }}" placeholder="6281234567890">
                            <small class="text-muted">Format: kode negara + nomor, tanpa + atau spasi.</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            {{-- Logo --}}
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-image me-2"></i>Logo Website</div>
                <div class="card-body p-4 text-center">
                    @php $logoVal = $settings['logo']->value ?? null; @endphp
                    <div id="logo-preview-wrap" style="margin-bottom:12px;">
                        @if($logoVal)
                            <img id="logo-preview" src="{{ asset('storage/'.$logoVal) }}" alt="Logo"
                                style="max-width:120px; max-height:120px; object-fit:contain; display:block; margin-inline:auto;">
                        @else
                            <div id="logo-preview-fallback" style="width:100px; height:100px; background:var(--red); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:2rem; color:white; font-weight:900; margin:0 auto;">
                                {{ $settings['singkatan']->value ?? 'S3' }}
                            </div>
                        @endif
                    </div>
                    <input type="file" name="logo" id="logo-input" class="form-control" accept="image/png,image/jpeg,image/jpg,image/svg+xml,image/webp">
                    <small class="text-muted mt-2 d-block">PNG/SVG/JPG/WEBP, maks 2MB. Digunakan di header & footer website.</small>
                </div>
            </div>

            {{-- Favicon --}}
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-badge me-2"></i>Favicon Browser</div>
                <div class="card-body p-4 text-center">
                    @php $faviconVal = $settings['favicon']->value ?? null; @endphp
                    <div id="favicon-preview-wrap" style="margin-bottom:12px;">
                        @if($faviconVal)
                            <img id="favicon-preview" src="{{ asset('storage/'.$faviconVal) }}" alt="Favicon"
                                style="width:64px; height:64px; object-fit:contain; display:block; margin-inline:auto; border:1px solid #eee; border-radius:8px; padding:4px;">
                        @else
                            <div id="favicon-preview-fallback" style="width:64px; height:64px; background:#f0f2f5; border:1px solid #ddd; border-radius:8px; display:flex; align-items:center; justify-content:center; margin:0 auto;">
                                <i class="bi bi-globe2" style="font-size:1.8rem; color:#aaa;"></i>
                            </div>
                        @endif
                    </div>
                    <input type="file" name="favicon" id="favicon-input" class="form-control" accept="image/png,image/jpeg,image/jpg,image/x-icon,image/svg+xml">
                    <small class="text-muted mt-2 d-block">PNG/ICO/SVG, maks 512KB. Ikon kecil di tab browser.</small>
                </div>
            </div>

            {{-- Simpan --}}
            <div class="admin-card card">
                <div class="card-body p-4">
                    <button type="submit" class="btn btn-admin-primary w-100 mb-2">
                        <i class="bi bi-save me-2"></i>Simpan Semua Pengaturan
                    </button>
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary w-100 rounded-2">
                        <i class="bi bi-box-arrow-up-right me-2"></i>Lihat Website
                    </a>
                    <p class="text-muted mt-3 mb-0" style="font-size:.78rem; text-align:center;">
                        <i class="bi bi-info-circle me-1"></i>Perubahan akan langsung tersinkronisasi ke seluruh halaman website.
                    </p>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection

@section('scripts')
<script>
// Live preview — logo
document.getElementById('logo-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (e) {
        const wrap = document.getElementById('logo-preview-wrap');
        wrap.innerHTML = '<img id="logo-preview" src="' + e.target.result + '" alt="Logo" style="max-width:120px;max-height:120px;object-fit:contain;display:block;margin-inline:auto;">';
    };
    reader.readAsDataURL(file);
});

// Live preview — favicon
document.getElementById('favicon-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (e) {
        const wrap = document.getElementById('favicon-preview-wrap');
        wrap.innerHTML = '<img id="favicon-preview" src="' + e.target.result + '" alt="Favicon" style="width:64px;height:64px;object-fit:contain;display:block;margin-inline:auto;border:1px solid #eee;border-radius:8px;padding:4px;">';
    };
    reader.readAsDataURL(file);
});
</script>
@endsection
