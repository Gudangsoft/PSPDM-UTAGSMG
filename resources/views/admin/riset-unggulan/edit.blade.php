@extends('layouts.admin')
@section('title', 'Edit Unggulan Riset')
@section('page-title', 'Edit Unggulan Riset')
@section('content')

<div class="mb-3">
    <a href="{{ route('admin.riset-unggulan.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<form action="{{ route('admin.riset-unggulan.update', $item) }}" method="POST">
    @csrf @method('PUT')
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card card mb-4">
                <div class="card-header">Data Unggulan Riset</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul', $item->judul) }}">
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card card mb-4">
                <div class="card-header">Tampilan & Pengaturan</div>
                <div class="card-body p-4">

                    {{-- Preview --}}
                    <div class="mb-4 text-center">
                        <div id="icon-preview" style="width:64px; height:64px; background:{{ old('warna', $item->warna) }}; border-radius:14px; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.6rem; margin:0 auto 8px;">
                            <i id="preview-icon" class="bi {{ old('icon', $item->icon) }}"></i>
                        </div>
                        <small class="text-muted">Preview ikon</small>
                    </div>

                    {{-- Icon --}}
                    <div class="mb-3">
                        <label class="form-label">Bootstrap Icon <span class="text-danger">*</span></label>
                        <input type="text" name="icon" id="icon-input" class="form-control @error('icon') is-invalid @enderror"
                               value="{{ old('icon', $item->icon) }}">
                        @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Cari di <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a></small>
                    </div>

                    {{-- Pilihan cepat ikon --}}
                    <div class="mb-3">
                        <label class="form-label" style="font-size:.78rem;">Pilihan Cepat</label>
                        <div class="d-flex flex-wrap gap-1">
                            @foreach(['bi-people-fill','bi-graph-up-arrow','bi-currency-exchange','bi-globe2','bi-lightbulb','bi-journal-richtext','bi-mortarboard','bi-briefcase','bi-bar-chart','bi-star','bi-trophy','bi-cpu','bi-heart','bi-building'] as $ic)
                            <button type="button" class="btn btn-sm btn-outline-secondary icon-pick p-1"
                                    style="width:34px;height:34px;" data-icon="{{ $ic }}" title="{{ $ic }}">
                                <i class="bi {{ $ic }}"></i>
                            </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Warna --}}
                    <div class="mb-3">
                        <label class="form-label">Warna <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="color" name="warna" id="color-input" class="form-control form-control-color"
                                   value="{{ old('warna', $item->warna) }}" style="width:50px; height:38px;">
                            <input type="text" id="color-text" class="form-control"
                                   value="{{ old('warna', $item->warna) }}" placeholder="#C0304A" style="font-family:monospace;">
                        </div>
                        <div class="d-flex gap-1 mt-2 flex-wrap">
                            @foreach(['#C0304A','#1a1a2e','#c8a84b','#2c7a4b','#1d4ed8','#7c3aed','#0891b2','#374151'] as $clr)
                            <button type="button" class="color-pick rounded" data-color="{{ $clr }}"
                                    style="width:26px;height:26px;background:{{ $clr }};border:2px solid #ddd;cursor:pointer;"></button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Urutan & Aktif --}}
                    <div class="mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $item->urutan) }}" min="0">
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                               {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active" style="font-weight:600;">Aktif</label>
                    </div>

                    <button type="submit" class="btn btn-admin-primary w-100">
                        <i class="bi bi-save me-2"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script>
(function () {
    const iconInput  = document.getElementById('icon-input');
    const colorInput = document.getElementById('color-input');
    const colorText  = document.getElementById('color-text');
    const previewBox = document.getElementById('icon-preview');
    const previewIco = document.getElementById('preview-icon');

    function updatePreview() {
        const cls = iconInput.value.trim();
        previewIco.className = 'bi ' + (cls || 'bi-lightbulb');
        previewBox.style.background = colorInput.value;
    }

    iconInput.addEventListener('input', updatePreview);
    colorInput.addEventListener('input', function () {
        colorText.value = this.value;
        updatePreview();
    });
    colorText.addEventListener('input', function () {
        if (/^#[0-9a-fA-F]{6}$/.test(this.value)) {
            colorInput.value = this.value;
            updatePreview();
        }
    });

    document.querySelectorAll('.icon-pick').forEach(btn => {
        btn.addEventListener('click', function () {
            iconInput.value = this.dataset.icon;
            updatePreview();
        });
    });

    document.querySelectorAll('.color-pick').forEach(btn => {
        btn.addEventListener('click', function () {
            colorInput.value = this.dataset.color;
            colorText.value  = this.dataset.color;
            updatePreview();
        });
    });
})();
</script>
@endsection
@endsection
