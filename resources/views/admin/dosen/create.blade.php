@extends('layouts.admin')
@section('title', 'Tambah Dosen')
@section('page-title', 'Tambah Data Dosen')
@section('content')
<div class="mb-3"><a href="{{ route('admin.dosen.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<form action="{{ route('admin.dosen.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card card mb-4">
                <div class="card-header">Data Dosen</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Nama Lengkap (dengan gelar) <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Prof. Dr. ...">
                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">NIDN</label>
                            <input type="text" name="nidn" class="form-control" value="{{ old('nidn') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan Akademik <span class="text-danger">*</span></label>
                            <select name="jabatan" class="form-select @error('jabatan') is-invalid @enderror">
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach(['Guru Besar / Professor', 'Lektor Kepala', 'Lektor', 'Asisten Ahli', 'Dosen Tetap', 'Dosen Tidak Tetap'] as $j)
                                <option value="{{ $j }}" {{ old('jabatan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                                @endforeach
                            </select>
                            @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Konsentrasi</label>
                            <select name="konsentrasi" class="form-select">
                                <option value="">-- Pilih Konsentrasi --</option>
                                @foreach(['Manajemen Modal Manusia Strategis', 'Manajemen Ekosistem Pasar Inovatif', 'Manajemen Keuangan Etis & Pengembangan Berkelanjutan'] as $k)
                                <option value="{{ $k }}" {{ old('konsentrasi') == $k ? 'selected' : '' }}>{{ $k }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Google Scholar URL</label>
                            <input type="url" name="google_scholar" class="form-control" value="{{ old('google_scholar') }}" placeholder="https://scholar.google.com/...">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Bidang Keahlian</label>
                            <input type="text" name="keahlian" class="form-control" value="{{ old('keahlian') }}" placeholder="Mis: Manajemen SDM, Kepemimpinan Strategis">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Biografi Singkat</label>
                            <textarea name="bio" rows="4" class="form-control" placeholder="Deskripsi singkat tentang dosen...">{{ old('bio') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="admin-card card mb-4">
                <div class="card-header">Foto & Pengaturan</div>
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <img id="preview" src="https://ui-avatars.com/api/?background=CC0000&color=fff&size=100" alt="" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border:3px solid #ffeeee;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Dosen</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewImg(this)">
                        <small class="text-muted">JPG/PNG, maks 2MB</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-600" for="is_active" style="font-weight:600;">Tampilkan di Website</label>
                    </div>
                    <button type="submit" class="btn btn-admin-primary w-100"><i class="bi bi-save me-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { document.getElementById('preview').src = e.target.result; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
