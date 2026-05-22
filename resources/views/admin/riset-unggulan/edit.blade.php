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

        {{-- Main --}}
        <div class="col-lg-8">
            <div class="admin-card card mb-4">
                <div class="card-header">Informasi Konsentrasi</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Nama Konsentrasi <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul', $item->judul) }}">
                            @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi Singkat</label>
                            <input type="text" name="deskripsi" class="form-control"
                                   value="{{ old('deskripsi', $item->deskripsi) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card card">
                <div class="card-header">Topik Riset Unggulan</div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        @foreach(['a'=>'Riset A','b'=>'Riset B','c'=>'Riset C'] as $key=>$label)
                        <div class="col-12">
                            <label class="form-label d-flex align-items-center gap-2">
                                <span class="badge" id="badge-{{ $key }}" style="background:{{ old('warna',$item->warna) }};">{{ $label }}</span>
                                {{ $label }}
                            </label>
                            <input type="text" name="topik_{{ $key }}" class="form-control"
                                   value="{{ old('topik_'.$key, $item->{'topik_'.$key}) }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            <div class="admin-card card">
                <div class="card-header">Warna & Pengaturan</div>
                <div class="card-body p-4">

                    {{-- Preview --}}
                    <div class="mb-4 p-3 rounded-3" id="preview-box"
                         style="border-left:4px solid {{ old('warna',$item->warna) }}; background:#f8fafc;">
                        <div id="preview-title" style="font-weight:700;font-size:.9rem;color:#1e293b;">{{ $item->judul }}</div>
                        <div id="preview-desc" style="font-size:.75rem;color:#6b7280;">{{ $item->deskripsi }}</div>
                        <div class="d-flex gap-1 mt-2 flex-wrap">
                            <span class="badge" id="prev-a" style="background:{{ old('warna',$item->warna) }};">Riset a</span>
                            <span class="badge" id="prev-b" style="background:{{ old('warna',$item->warna) }};">Riset b</span>
                            <span class="badge" id="prev-c" style="background:{{ old('warna',$item->warna) }};">Riset c</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Warna Konsentrasi <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <input type="color" name="warna" id="color-input"
                                   class="form-control form-control-color"
                                   value="{{ old('warna',$item->warna) }}" style="width:50px;height:38px;">
                            <input type="text" id="color-text" class="form-control"
                                   value="{{ old('warna',$item->warna) }}" placeholder="#C0304A" style="font-family:monospace;">
                        </div>
                        <div class="d-flex gap-1 flex-wrap">
                            @foreach(['#C0304A','#0d9488','#1d4ed8','#7c3aed','#c8a84b','#1a1a2e','#0891b2','#374151'] as $clr)
                            <button type="button" class="color-pick rounded" data-color="{{ $clr }}"
                                    style="width:26px;height:26px;background:{{ $clr }};border:2px solid #ddd;cursor:pointer;"></button>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-control"
                               value="{{ old('urutan', $item->urutan) }}" min="0">
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                               id="is_active" {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
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
    const colorIn   = document.getElementById('color-input');
    const colorTxt  = document.getElementById('color-text');
    const prevBox   = document.getElementById('preview-box');
    const prevTitle = document.getElementById('preview-title');
    const prevDesc  = document.getElementById('preview-desc');

    function applyColor(hex) {
        prevBox.style.borderLeftColor = hex;
        ['prev-a','prev-b','prev-c'].forEach(id => document.getElementById(id).style.background = hex);
        ['badge-a','badge-b','badge-c'].forEach(id => { const el = document.getElementById(id); if(el) el.style.background = hex; });
    }

    colorIn.addEventListener('input', function () { colorTxt.value = this.value; applyColor(this.value); });
    colorTxt.addEventListener('input', function () {
        if (/^#[0-9a-fA-F]{6}$/.test(this.value)) { colorIn.value = this.value; applyColor(this.value); }
    });
    document.querySelectorAll('.color-pick').forEach(btn => btn.addEventListener('click', function () {
        colorIn.value = colorTxt.value = this.dataset.color; applyColor(this.dataset.color);
    }));

    document.querySelector('[name=judul]').addEventListener('input', function () {
        prevTitle.textContent = this.value || 'Nama Konsentrasi';
    });
    document.querySelector('[name=deskripsi]').addEventListener('input', function () {
        prevDesc.textContent = this.value || 'Deskripsi singkat';
    });
})();
</script>
@endsection
@endsection
