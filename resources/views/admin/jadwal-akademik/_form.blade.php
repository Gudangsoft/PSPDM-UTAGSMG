@php $model = $model ?? null; @endphp

@if($errors->any())
<div class="alert alert-danger mb-3">
    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Tahun Akademik <span class="text-danger">*</span></label>
        <input type="text" name="tahun_akademik" class="form-control"
               value="{{ old('tahun_akademik', $model->tahun_akademik ?? '2026/2027') }}"
               placeholder="cth: 2026/2027" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Semester <span class="text-danger">*</span></label>
        <select name="semester" class="form-select" required>
            <option value="gasal"  {{ old('semester', $model->semester ?? '') === 'gasal'  ? 'selected' : '' }}>Gasal</option>
            <option value="genap"  {{ old('semester', $model->semester ?? '') === 'genap'  ? 'selected' : '' }}>Genap</option>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">No. Urut <span class="text-danger">*</span></label>
        <input type="number" name="no_urut" class="form-control"
               value="{{ old('no_urut', $model->no_urut ?? 1) }}" min="1" max="99" required>
    </div>
    <div class="col-md-8">
        <label class="form-label">Periode <span class="text-danger">*</span></label>
        <input type="text" name="periode" class="form-control"
               value="{{ old('periode', $model->periode ?? '') }}"
               placeholder="cth: 15 Sep 2026 – 15 Jan 2027" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Jenis Kegiatan <span class="text-danger">*</span></label>
        <select name="jenis" class="form-select" required>
            <option value="administrasi" {{ old('jenis', $model->jenis ?? '') === 'administrasi' ? 'selected' : '' }}>Administrasi</option>
            <option value="perkuliahan"  {{ old('jenis', $model->jenis ?? '') === 'perkuliahan'  ? 'selected' : '' }}>Perkuliahan</option>
            <option value="evaluasi"     {{ old('jenis', $model->jenis ?? '') === 'evaluasi'     ? 'selected' : '' }}>Evaluasi</option>
            <option value="sidang"       {{ old('jenis', $model->jenis ?? '') === 'sidang'       ? 'selected' : '' }}>Sidang</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Kegiatan Akademik <span class="text-danger">*</span></label>
        <input type="text" name="kegiatan" class="form-control"
               value="{{ old('kegiatan', $model->kegiatan ?? '') }}"
               placeholder="cth: Ujian Tengah Semester (UTS)" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="is_active" class="form-select">
            <option value="1" {{ old('is_active', $model->is_active ?? 1) ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !old('is_active', $model->is_active ?? 1) ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
</div>
