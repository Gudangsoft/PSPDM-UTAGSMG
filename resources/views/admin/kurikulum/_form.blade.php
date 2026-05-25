@php $model = $model ?? null; @endphp

@if($errors->any())
<div class="alert alert-danger mb-3">
    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="row g-3">
    <div class="col-md-3">
        <label class="form-label">Kode MK</label>
        <input type="text" name="kode_mk" class="form-control" value="{{ old('kode_mk', $model->kode_mk ?? '') }}"
               placeholder="cth: MAN501">
    </div>
    <div class="col-md-9">
        <label class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
        <input type="text" name="nama_mk" class="form-control" value="{{ old('nama_mk', $model->nama_mk ?? '') }}"
               placeholder="cth: Metodologi Penelitian Manajemen" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">SKS <span class="text-danger">*</span></label>
        <input type="number" name="sks" class="form-control" value="{{ old('sks', $model->sks ?? 3) }}"
               min="1" max="6" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">Semester <span class="text-danger">*</span></label>
        <select name="semester" class="form-select" required>
            @for($s = 1; $s <= 8; $s++)
            <option value="{{ $s }}" {{ old('semester', $model->semester ?? 1) == $s ? 'selected' : '' }}>
                Semester {{ $s }}
            </option>
            @endfor
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Jenis <span class="text-danger">*</span></label>
        <select name="jenis" class="form-select" required>
            <option value="wajib"   {{ old('jenis', $model->jenis ?? 'wajib') === 'wajib'   ? 'selected' : '' }}>Wajib</option>
            <option value="pilihan" {{ old('jenis', $model->jenis ?? 'wajib') === 'pilihan' ? 'selected' : '' }}>Pilihan</option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Urutan Tampil <span class="text-danger">*</span></label>
        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $model->urutan ?? 0) }}"
               min="0" required>
        <small class="text-muted">Dalam satu semester.</small>
    </div>
    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="is_active" class="form-select">
            <option value="1" {{ old('is_active', $model->is_active ?? 1) ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !old('is_active', $model->is_active ?? 1) ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Keterangan / Deskripsi</label>
        <textarea name="keterangan" rows="3" class="form-control"
                  placeholder="Deskripsi singkat mata kuliah, capaian pembelajaran, dll.">{{ old('keterangan', $model->keterangan ?? '') }}</textarea>
    </div>
</div>
