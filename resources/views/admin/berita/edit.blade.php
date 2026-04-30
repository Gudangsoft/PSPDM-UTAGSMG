@extends('layouts.admin')
@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
@endsection
@section('content')

<div class="mb-3">
    <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card card mb-4">
                <div class="card-header">Konten Berita</div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $berita->judul) }}">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ringkasan</label>
                        <textarea name="ringkasan" rows="2" class="form-control">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Berita <span class="text-danger">*</span></label>
                        <textarea name="konten" id="konten" class="form-control">{{ old('konten', $berita->konten) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card card mb-4">
                <div class="card-header">Pengaturan Publikasi</div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" class="form-select">
                            @foreach(['Berita', 'Pengumuman', 'Akademik', 'Kegiatan', 'Prestasi', 'Penelitian'] as $kat)
                            <option value="{{ $kat }}" {{ old('kategori', $berita->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $berita->penulis) }}">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" {{ old('is_published', $berita->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label fw-600" for="is_published" style="font-weight:600;">Terbitkan</label>
                    </div>
                </div>
            </div>

            <div class="admin-card card mb-4">
                <div class="card-header">Gambar Utama</div>
                <div class="card-body p-4">
                    @if($berita->gambar)
                    <img src="{{ $berita->gambar_url }}" alt="" style="width:100%; border-radius:10px; margin-bottom:12px; max-height:160px; object-fit:cover;">
                    @endif
                    <img id="preview" src="" alt="" style="width:100%; border-radius:10px; display:none; max-height:160px; object-fit:cover; margin-bottom:8px;">
                    <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImg(this)">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary w-100">
                <i class="bi bi-save me-2"></i>Simpan Perubahan
            </button>
        </div>
    </div>
</form>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>
$('#konten').summernote({ height: 350 });
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { const img = document.getElementById('preview'); img.src = e.target.result; img.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
