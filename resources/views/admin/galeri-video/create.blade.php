@extends('layouts.admin')
@section('title', 'Tambah Video Galeri')
@section('page-title', 'Tambah Video Galeri')
@section('content')
<div class="mb-3"><a href="{{ route('admin.galeri-video.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="admin-card card">
            <div class="card-header">Form Video</div>
            <div class="card-body p-4">
                <div class="alert alert-info" style="font-size:.85rem;">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    Tempel link video dari <strong>YouTube</strong>, <strong>Instagram</strong> (Reel/Post), atau <strong>TikTok</strong> &mdash; sistem otomatis mendeteksi platformnya.
                </div>
                <form action="{{ route('admin.galeri-video.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Link Video <span class="text-danger">*</span></label>
                        <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                            value="{{ old('url') }}" placeholder="https://www.youtube.com/watch?v=..." oninput="detectPlatform(this.value)" required>
                        @error('url')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        <div id="platform-badge" class="mt-2"></div>
                    </div>
                    <div id="preview-wrap" class="mb-3" style="display:none;">
                        <div id="preview-ratio" class="ratio ratio-16x9" style="border-radius:12px; overflow:hidden; background:#f5f5f5; max-width:280px;">
                            <iframe id="preview-frame" src="" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div id="preview-note" class="alert alert-secondary mb-3" style="display:none; font-size:.8rem;"></div>
                    <div class="mb-3">
                        <label class="form-label">Judul Video <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-600" for="is_active" style="font-weight:600;">Tampilkan di Galeri</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" rows="2" class="form-control">{{ old('deskripsi') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-admin-primary w-100"><i class="bi bi-plus-lg me-2"></i>Simpan Video</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function detectPlatform(url) {
    const badge = document.getElementById('platform-badge');
    const wrap  = document.getElementById('preview-wrap');
    const ratio = document.getElementById('preview-ratio');
    const frame = document.getElementById('preview-frame');
    const note  = document.getElementById('preview-note');
    badge.innerHTML = '';
    wrap.style.display = 'none';
    note.style.display = 'none';
    frame.src = '';

    let label = null, icon = null;

    try {
        const host = new URL(url).hostname.toLowerCase();

        if (host.includes('youtube.com') || host.includes('youtu.be')) {
            label = 'YouTube'; icon = 'bi-youtube';
            const m = url.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|shorts\/|embed\/|live\/))([A-Za-z0-9_-]{11})/);
            if (m) {
                ratio.classList.add('ratio-16x9');
                ratio.classList.remove('ratio-9x16');
                ratio.style.maxWidth = '100%';
                frame.src = 'https://www.youtube.com/embed/' + m[1];
                wrap.style.display = 'block';
            }
        } else if (host.includes('instagram.com') || host.includes('tiktok.com')) {
            label = host.includes('instagram.com') ? 'Instagram' : 'TikTok';
            icon  = host.includes('instagram.com') ? 'bi-instagram' : 'bi-tiktok';
            note.innerHTML = '<i class="bi bi-info-circle me-1"></i>Pratinjau langsung tidak tersedia untuk ' + label + ' di form ini. Setelah disimpan, video akan tampil di halaman <strong>Galeri Video</strong> publik.';
            note.style.display = 'block';
        }
    } catch (e) { /* incomplete URL while typing */ }

    if (label) {
        badge.innerHTML = `<span class="badge rounded-pill" style="background:#f0f4ff;color:#1a1a2e;font-size:.78rem;"><i class="bi ${icon} me-1"></i>${label}</span>`;
    }
}
@if(old('url'))
detectPlatform(@json(old('url')));
@endif
</script>
@endsection
