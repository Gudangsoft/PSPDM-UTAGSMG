@extends('layouts.admin')
@section('title', 'Edit Dosen')
@section('page-title', 'Edit Data Dosen')
@section('content')
<div class="mb-3"><a href="{{ route('admin.dosen.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<form action="{{ route('admin.dosen.update', $dosen) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card card mb-4">
                <div class="card-header">Data Dosen</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $dosen->nama) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">NIDN</label>
                            <input type="text" name="nidn" class="form-control" value="{{ old('nidn', $dosen->nidn) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan Akademik <span class="text-danger">*</span></label>
                            <select name="jabatan" class="form-select">
                                <option value="">-- Pilih Jabatan --</option>
                                @foreach($jabatans as $j)
                                <option value="{{ $j->nama }}" {{ old('jabatan', $dosen->jabatan) == $j->nama ? 'selected' : '' }}>{{ $j->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Konsentrasi</label>
                            <select name="konsentrasi" class="form-select">
                                <option value="">-- Pilih --</option>
                                @foreach($konsentrasis as $k)
                                <option value="{{ $k->nama }}" {{ old('konsentrasi', $dosen->konsentrasi) == $k->nama ? 'selected' : '' }}>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $dosen->email) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Google Scholar URL</label>
                            <input type="url" name="google_scholar" class="form-control" value="{{ old('google_scholar', $dosen->google_scholar) }}" placeholder="https://scholar.google.com/...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">SINTA URL</label>
                            <input type="url" name="sinta_url" class="form-control" value="{{ old('sinta_url', $dosen->sinta_url ?? '') }}" placeholder="https://sinta.kemdikbud.go.id/...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Scopus URL</label>
                            <input type="url" name="scopus_url" class="form-control" value="{{ old('scopus_url', $dosen->scopus_url ?? '') }}" placeholder="https://www.scopus.com/...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">ResearchGate URL</label>
                            <input type="url" name="researchgate_url" class="form-control" value="{{ old('researchgate_url', $dosen->researchgate_url ?? '') }}" placeholder="https://www.researchgate.net/...">
                        </div>
                        <div class="col-12">
                            <label class="form-label">URL Slug <small class="text-muted">(bagian URL: /dosen/<strong>slug</strong>)</small></label>
                            <div class="input-group">
                                <span class="input-group-text text-muted" style="font-size:.8rem;">/dosen/</span>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug', $dosen->slug) }}" placeholder="otomatis dari nama">
                            </div>
                            <small class="text-muted">Kosongkan untuk tidak mengubah. Hanya huruf kecil, angka, dan tanda hubung.</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Keahlian <small class="text-muted">(pisah dengan koma)</small></label>
                            <input type="text" name="keahlian" class="form-control" value="{{ old('keahlian', $dosen->keahlian) }}" placeholder="Mis: Manajemen SDM, Kepemimpinan Strategis">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Biografi</label>
                            <textarea name="bio" rows="6" class="form-control" placeholder="Deskripsi lengkap tentang dosen...">{{ old('bio', $dosen->bio) }}</textarea>
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
                        <img id="preview" src="{{ $dosen->foto_url }}" alt="" style="width:100px; height:100px; border-radius:50%; object-fit:cover; border:3px solid #ffeeee;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewImg(this)">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $dosen->urutan) }}" min="0">
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $dosen->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-600" for="is_active" style="font-weight:600;">Aktif</label>
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
