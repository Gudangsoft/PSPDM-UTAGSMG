@extends('layouts.admin')
@section('title', 'Upload Foto Galeri')
@section('page-title', 'Upload Foto Galeri')
@section('content')
<div class="mb-3"><a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="admin-card card">
            <div class="card-header">Form Upload Foto</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Foto <span class="text-danger">*</span></label>
                        <div id="dropzone" class="border-2 border-dashed rounded-3 p-4 text-center mb-2" style="border:2px dashed #ddd; cursor:pointer; transition:border-color .2s;" onclick="document.getElementById('gambar').click()">
                            <img id="preview" src="" alt="" style="max-width:100%; max-height:200px; border-radius:8px; display:none;">
                            <div id="placeholder"><i class="bi bi-cloud-upload" style="font-size:2.5rem; color:#ddd;"></i><p class="text-muted mt-2 mb-0" style="font-size:.875rem;">Klik atau seret foto ke sini</p><small class="text-muted">JPG/PNG/WebP, maks 3MB</small></div>
                        </div>
                        <input type="file" name="gambar" id="gambar" class="d-none @error('gambar') is-invalid @enderror" accept="image/*" onchange="previewImg(this)" required>
                        @error('gambar')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul Foto <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select">
                                @foreach(['Kegiatan', 'Wisuda', 'Seminar', 'Penelitian', 'Kampus', 'Umum'] as $k)
                                <option value="{{ $k }}" {{ old('kategori') == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" rows="2" class="form-control">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-600" for="is_active" style="font-weight:600;">Tampilkan di Galeri</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-admin-primary w-100"><i class="bi bi-upload me-2"></i>Upload Foto</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('preview').style.display = 'block';
            document.getElementById('placeholder').style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
