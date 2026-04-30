@extends('layouts.admin')
@section('title', 'Edit Foto Galeri')
@section('page-title', 'Edit Foto Galeri')
@section('content')
<div class="mb-3"><a href="{{ route('admin.galeri.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="admin-card card">
            <div class="card-header">Edit Foto</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.galeri.update', $galeri) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Foto Saat Ini</label>
                        <div><img src="{{ $galeri->gambar_url }}" alt="" style="max-width:100%; max-height:200px; border-radius:8px; object-fit:cover;"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Foto</label>
                        <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImg(this)">
                        <img id="preview" src="" alt="" style="max-width:100%; max-height:150px; border-radius:8px; display:none; margin-top:8px;">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul Foto <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $galeri->judul) }}">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select">
                                @foreach(['Kegiatan', 'Wisuda', 'Seminar', 'Penelitian', 'Kampus', 'Umum'] as $k)
                                <option value="{{ $k }}" {{ old('kategori', $galeri->kategori) == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $galeri->urutan) }}" min="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" rows="2" class="form-control">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $galeri->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-600" for="is_active" style="font-weight:600;">Aktif</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-admin-primary w-100"><i class="bi bi-save me-2"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { const img = document.getElementById('preview'); img.src = e.target.result; img.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
