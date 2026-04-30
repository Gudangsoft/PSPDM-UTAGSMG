@php $model = $model ?? null; @endphp

@if($errors->any())
<div class="alert alert-danger mb-3">
    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control" value="{{ old('nama', $model->nama ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Urutan Tampil <span class="text-danger">*</span></label>
        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $model->urutan ?? 0) }}" min="0" required>
        <small class="text-muted">Angka lebih kecil = tampil lebih dulu.</small>
    </div>
    <div class="col-12">
        <label class="form-label">Jabatan / Posisi <span class="text-danger">*</span></label>
        <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $model->jabatan ?? '') }}"
               placeholder="cth: Ketua Program Studi, Sekretaris Program Studi" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">NIDN</label>
        <input type="text" name="nidn" class="form-control" value="{{ old('nidn', $model->nidn ?? '') }}" placeholder="0000000000">
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $model->email ?? '') }}" placeholder="nama@untag-smg.ac.id">
    </div>
    <div class="col-md-6">
        <label class="form-label">Telepon</label>
        <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $model->telepon ?? '') }}" placeholder="(024) ...">
    </div>
    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="is_active" class="form-select">
            <option value="1" {{ old('is_active', $model->is_active ?? 1) ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !old('is_active', $model->is_active ?? 1) ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Keterangan / Bio Singkat</label>
        <textarea name="keterangan" rows="3" class="form-control" placeholder="Bidang keahlian, latar belakang, dll.">{{ old('keterangan', $model->keterangan ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Foto</label>
        @if($model && $model->foto)
            <div class="mb-2 d-flex align-items-center gap-3">
                <img src="{{ asset('storage/'.$model->foto) }}" alt="Foto"
                     style="width:72px;height:72px;object-fit:cover;border-radius:50%;border:2px solid #eee;">
                <small class="text-muted">Foto saat ini. Upload baru untuk mengganti.</small>
            </div>
        @endif
        <input type="file" name="foto" id="foto-input" class="form-control" accept="image/png,image/jpeg,image/jpg,image/webp">
        <small class="text-muted">PNG/JPG/WEBP, maks 2MB. Rasio 1:1 (persegi) lebih disarankan.</small>
    </div>
</div>
