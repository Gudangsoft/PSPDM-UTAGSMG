@php $model = $model ?? null; @endphp

@if($errors->any())
<div class="alert alert-danger mb-3">
    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Label Menu <span class="text-danger">*</span></label>
        <input type="text" name="label" class="form-control"
               value="{{ old('label', $model->label ?? '') }}"
               placeholder="cth: Tentang, Akademik, Kontak" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Urutan <span class="text-danger">*</span></label>
        <input type="number" name="urutan" class="form-control"
               value="{{ old('urutan', $model->urutan ?? 0) }}" min="0" required>
        <small class="text-muted">Angka kecil = tampil lebih dulu.</small>
    </div>

    <div class="col-md-6">
        <label class="form-label">Tipe Link <span class="text-danger">*</span></label>
        <select name="tipe" id="tipe-select" class="form-select" required>
            <option value="route" {{ old('tipe', $model->tipe ?? '') == 'route' ? 'selected' : '' }}>Route (Halaman Bawaan)</option>
            <option value="page"  {{ old('tipe', $model->tipe ?? '') == 'page'  ? 'selected' : '' }}>Halaman Dinamis</option>
            <option value="url"   {{ old('tipe', $model->tipe ?? '') == 'url'   ? 'selected' : '' }}>URL Eksternal / Custom</option>
        </select>
    </div>

    <div class="col-md-6" id="nilai-group">
        {{-- Rendered by JS --}}
    </div>

    {{-- Hidden nilai input untuk route & url --}}
    <input type="hidden" name="nilai" id="nilai-hidden" value="{{ old('nilai', $model->nilai ?? '') }}">

    <div class="col-md-6">
        <label class="form-label">Parent Menu</label>
        <select name="parent_id" class="form-select">
            <option value="">— Top Level (tidak ada parent) —</option>
            @foreach($parents as $p)
                <option value="{{ $p->id }}" {{ old('parent_id', $model->parent_id ?? '') == $p->id ? 'selected' : '' }}>
                    {{ $p->label }}
                </option>
            @endforeach
        </select>
        <small class="text-muted">Pilih parent jika item ini adalah sub-menu (dropdown).</small>
    </div>

    <div class="col-md-3">
        <label class="form-label">Icon (Bootstrap Icons)</label>
        <div class="input-group">
            <span class="input-group-text" id="icon-preview"><i class="bi {{ old('icon', $model->icon ?? 'bi-link-45deg') }}"></i></span>
            <input type="text" name="icon" id="icon-input" class="form-control"
                   value="{{ old('icon', $model->icon ?? '') }}"
                   placeholder="bi-house, bi-people, ...">
        </div>
        <small class="text-muted">Lihat: <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a></small>
    </div>

    <div class="col-md-3">
        <label class="form-label">Target</label>
        <select name="target" class="form-select">
            <option value="_self"  {{ old('target', $model->target ?? '_self')  == '_self'  ? 'selected' : '' }}>_self (tab sama)</option>
            <option value="_blank" {{ old('target', $model->target ?? '_self') == '_blank' ? 'selected' : '' }}>_blank (tab baru)</option>
        </select>
    </div>

    <div class="col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                   {{ old('is_active', $model->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="is_active">Aktifkan Item Menu</label>
        </div>
    </div>
</div>

@php
    $availableRoutes = [
        'home'            => 'Beranda',
        'tentang'         => 'Tentang / Profil Program',
        'struktur'        => 'Struktur Organisasi',
        'dosen'           => 'Dosen & Staf',
        'konsentrasi'     => 'Konsentrasi',
        'profil-lulusan'  => 'Profil Lulusan',
        'akademik'        => 'Kurikulum & Syarat',
        'penelitian'      => 'Penelitian',
        'berita.index'    => 'Berita',
        'pengumuman.index'=> 'Pengumuman',
        'galeri'          => 'Galeri',
        'kontak'          => 'Kontak',
    ];
    $currentNilai = old('nilai', $model->nilai ?? '');
    $currentTipe  = old('tipe',  $model->tipe  ?? 'route');
@endphp

@section('scripts')
@parent
<script>
const availableRoutes = @json($availableRoutes);
const halamanList     = @json($halaman->map(fn($h) => ['slug' => $h->slug, 'judul' => $h->judul]));
const currentTipe     = "{{ $currentTipe }}";
const currentNilai    = "{{ $currentNilai }}";

function renderNilaiGroup(tipe) {
    const group = document.getElementById('nilai-group');
    const hidden = document.getElementById('nilai-hidden');

    if (tipe === 'route') {
        let opts = '<option value="">— Pilih Route —</option>';
        for (const [val, label] of Object.entries(availableRoutes)) {
            const sel = (currentNilai === val && currentTipe === 'route') ? 'selected' : '';
            opts += `<option value="${val}" ${sel}>${label} (${val})</option>`;
        }
        group.innerHTML = `
            <label class="form-label">Nama Route <span class="text-danger">*</span></label>
            <select id="nilai-select" class="form-select">${opts}</select>
            <small class="text-muted">Route bawaan sistem.</small>`;
        document.getElementById('nilai-select').addEventListener('change', e => hidden.value = e.target.value);
        if (document.getElementById('nilai-select').value) hidden.value = document.getElementById('nilai-select').value;

    } else if (tipe === 'page') {
        let opts = '<option value="">— Pilih Halaman —</option>';
        halamanList.forEach(h => {
            const sel = (currentNilai === h.slug && currentTipe === 'page') ? 'selected' : '';
            opts += `<option value="${h.slug}" ${sel}>${h.judul}</option>`;
        });
        group.innerHTML = `
            <label class="form-label">Halaman Dinamis <span class="text-danger">*</span></label>
            <select id="nilai-select" class="form-select">${opts}</select>
            <small class="text-muted">Pilih halaman yang sudah dibuat.</small>`;
        document.getElementById('nilai-select').addEventListener('change', e => hidden.value = e.target.value);
        if (document.getElementById('nilai-select').value) hidden.value = document.getElementById('nilai-select').value;

    } else {
        const val = (currentTipe === 'url') ? currentNilai : '';
        group.innerHTML = `
            <label class="form-label">URL <span class="text-danger">*</span></label>
            <input type="text" id="nilai-text" class="form-control" value="${val}" placeholder="https://... atau /halaman-custom">
            <small class="text-muted">URL penuh atau path relatif.</small>`;
        document.getElementById('nilai-text').addEventListener('input', e => hidden.value = e.target.value);
        hidden.value = val;
    }
}

// Init
renderNilaiGroup(currentTipe);
document.getElementById('tipe-select').addEventListener('change', function () {
    renderNilaiGroup(this.value);
});

// Icon preview
document.getElementById('icon-input').addEventListener('input', function () {
    document.getElementById('icon-preview').innerHTML = `<i class="bi ${this.value || 'bi-link-45deg'}"></i>`;
});
</script>
@endsection
