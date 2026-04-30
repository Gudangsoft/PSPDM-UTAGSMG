@if($errors->any())
<div class="alert alert-danger mb-4">
    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card card mb-4">
            <div class="card-header"><i class="bi bi-file-earmark-text me-2"></i>Konten Halaman</div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label">Judul Halaman <span class="text-danger">*</span></label>
                    <input type="text" name="judul" id="judul-input" class="form-control"
                           value="{{ old('judul', $model->judul ?? '') }}"
                           placeholder="Judul halaman..." required>
                </div>
                @isset($model)
                <div class="mb-3">
                    <label class="form-label">Slug (URL)</label>
                    <div class="input-group">
                        <span class="input-group-text text-muted" style="font-size:.82rem;">/halaman/</span>
                        <input type="text" class="form-control" value="{{ $model->slug }}" disabled style="background:#f8f9fa;">
                    </div>
                    <small class="text-muted">Slug otomatis dibuat dari judul.</small>
                </div>
                @endisset
                <div class="mb-3">
                    <label class="form-label">Isi Konten <span class="text-danger">*</span></label>
                    <textarea name="konten" id="konten" class="form-control">{{ old('konten', $model->konten ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card card mb-4">
            <div class="card-header"><i class="bi bi-gear me-2"></i>Pengaturan</div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label">Meta Deskripsi</label>
                    <textarea name="meta_deskripsi" rows="3" class="form-control"
                              placeholder="Deskripsi untuk mesin pencari (SEO)...">{{ old('meta_deskripsi', $model->meta_deskripsi ?? '') }}</textarea>
                    <small class="text-muted">Maks 300 karakter.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="urutan" class="form-control"
                           value="{{ old('urutan', $model->urutan ?? 0) }}" min="0">
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published"
                               {{ old('is_published', $model->is_published ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_published">Terbitkan Halaman</label>
                    </div>
                    <small class="text-muted">Jika nonaktif, halaman tidak bisa diakses publik.</small>
                </div>
            </div>
        </div>

        <div class="admin-card card">
            <div class="card-body p-4">
                <button type="submit" class="btn btn-admin-primary w-100 mb-2">
                    <i class="bi bi-save me-2"></i>Simpan Halaman
                </button>
                <a href="{{ route('admin.halaman.index') }}" class="btn btn-outline-secondary w-100 rounded-2">Batal</a>
            </div>
        </div>
    </div>
</div>
