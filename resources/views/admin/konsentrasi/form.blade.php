@extends('layouts.admin')
@section('title', $konsentrasi->exists ? 'Edit Konsentrasi' : 'Tambah Konsentrasi')
@section('page-title', $konsentrasi->exists ? 'Edit Konsentrasi' : 'Tambah Konsentrasi')

@section('content')

@if($errors->any())
<div class="alert alert-danger rounded-3 mb-4">
    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<form action="{{ $konsentrasi->exists ? route('admin.konsentrasi.update', $konsentrasi) : route('admin.konsentrasi.store') }}"
      method="POST" enctype="multipart/form-data">
    @csrf
    @if($konsentrasi->exists) @method('PUT') @endif

    <div class="row g-4">
        {{-- ── Kolom Kiri ── --}}
        <div class="col-lg-8">
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-type me-2"></i>Informasi Konsentrasi</div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Konsentrasi (Indonesia) <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $konsentrasi->nama) }}"
                               placeholder="contoh: Manajemen Modal Manusia Strategis"
                               maxlength="200" required autofocus>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Konsentrasi (Inggris)</label>
                        <input type="text" name="nama_en" class="form-control @error('nama_en') is-invalid @enderror"
                               value="{{ old('nama_en', $konsentrasi->nama_en) }}"
                               placeholder="contoh: Human Capital Strategic Management"
                               maxlength="200">
                        @error('nama_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Paragraf pertama deskripsi konsentrasi..." required>{{ old('deskripsi', $konsentrasi->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi Lanjutan</label>
                        <textarea name="deskripsi_lanjutan" rows="3" class="form-control"
                                  placeholder="Paragraf kedua (opsional)...">{{ old('deskripsi_lanjutan', $konsentrasi->deskripsi_lanjutan) }}</textarea>
                    </div>

                    <div>
                        <label class="form-label fw-semibold">Topik Kajian Utama</label>
                        <textarea name="topik_raw" rows="7" class="form-control"
                                  placeholder="Satu topik per baris, contoh:&#10;Manajemen SDM Strategis&#10;Pengembangan Organisasi&#10;Kepemimpinan Transformasional">{{ old('topik_raw', $konsentrasi->exists ? implode("\n", $konsentrasi->topik ?? []) : '') }}</textarea>
                        <small class="text-muted">Tulis satu topik per baris. Akan ditampilkan sebagai badge di halaman konsentrasi.</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Kolom Kanan ── --}}
        <div class="col-lg-4">
            <div class="admin-card card mb-4">
                <div class="card-header"><i class="bi bi-palette me-2"></i>Tampilan & Pengaturan</div>
                <div class="card-body p-4">

                    {{-- Gambar --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Konsentrasi</label>

                        {{-- Preview area --}}
                        <div id="img-preview-wrap" style="width:100%;height:160px;border-radius:12px;overflow:hidden;background:#f0f2f5;display:flex;align-items:center;justify-content:center;margin-bottom:10px;border:2px dashed #ddd;">
                            @if($konsentrasi->gambar)
                                <img id="img-preview" src="{{ asset('storage/' . $konsentrasi->gambar) }}"
                                     style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div id="img-placeholder" style="text-align:center;color:#aaa;">
                                    <i class="bi bi-image fs-1 d-block mb-1"></i>
                                    <span style="font-size:.75rem;">Belum ada gambar</span>
                                </div>
                                <img id="img-preview" src="" style="width:100%;height:100%;object-fit:cover;display:none;">
                            @endif
                        </div>

                        <input type="file" name="gambar" id="gambar-input"
                               class="form-control @error('gambar') is-invalid @enderror"
                               accept="image/jpg,image/jpeg,image/png,image/webp">
                        @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">JPG/PNG/WEBP, maks. 2 MB. Direkomendasikan ukuran kotak (1:1).</small>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Warna Primer</label>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="color" name="warna_primer" class="form-control form-control-color"
                                       value="{{ old('warna_primer', $konsentrasi->warna_primer ?? '#C0304A') }}"
                                       style="width:48px;height:38px;padding:2px;">
                                <input type="text" id="warna_primer_text" class="form-control"
                                       value="{{ old('warna_primer', $konsentrasi->warna_primer ?? '#C0304A') }}"
                                       style="font-size:.8rem;" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Warna Sekunder</label>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="color" name="warna_sekunder" class="form-control form-control-color"
                                       value="{{ old('warna_sekunder', $konsentrasi->warna_sekunder ?? '#8B1A2E') }}"
                                       style="width:48px;height:38px;padding:2px;">
                                <input type="text" id="warna_sekunder_text" class="form-control"
                                       value="{{ old('warna_sekunder', $konsentrasi->warna_sekunder ?? '#8B1A2E') }}"
                                       style="font-size:.8rem;" readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Gradient preview strip --}}
                    <div id="gradient-preview" style="height:12px;border-radius:6px;margin-bottom:16px;background:linear-gradient(135deg,{{ $konsentrasi->warna_primer ?? '#C0304A' }},{{ $konsentrasi->warna_sekunder ?? '#8B1A2E' }});"></div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Urutan</label>
                        <input type="number" name="urutan" class="form-control"
                               value="{{ old('urutan', $konsentrasi->urutan ?? 0) }}"
                               min="0" max="255">
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                               {{ old('is_active', $konsentrasi->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_active">Tampilkan di website</label>
                    </div>

                    <button type="submit" class="btn btn-admin-primary w-100">
                        <i class="bi bi-save me-2"></i>Simpan
                    </button>
                    <a href="{{ route('admin.konsentrasi.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('scripts')
<script>
// Live image preview
document.getElementById('gambar-input').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (e) {
        const preview = document.getElementById('img-preview');
        const placeholder = document.getElementById('img-placeholder');
        preview.src = e.target.result;
        preview.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
    };
    reader.readAsDataURL(file);
});

// Sync color picker → text display + update gradient preview
function syncColor(inputName, textId) {
    const picker = document.querySelector('[name="' + inputName + '"]');
    const text   = document.getElementById(textId);
    picker.addEventListener('input', function () {
        text.value = this.value;
        updatePreview();
    });
}
function updatePreview() {
    const p  = document.querySelector('[name="warna_primer"]').value;
    const s  = document.querySelector('[name="warna_sekunder"]').value;
    document.getElementById('gradient-preview').style.background =
        'linear-gradient(135deg,' + p + ',' + s + ')';
}
syncColor('warna_primer',   'warna_primer_text');
syncColor('warna_sekunder', 'warna_sekunder_text');
</script>
@endsection
