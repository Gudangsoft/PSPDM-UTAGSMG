@extends('layouts.admin')
@section('title', $jadwal->exists ? 'Edit Jadwal PMB' : 'Tambah Jadwal PMB')
@section('page-title', $jadwal->exists ? 'Edit Jadwal PMB' : 'Tambah Jadwal PMB')

@section('content')

@if($errors->any())
<div class="alert alert-danger rounded-3 mb-4">
    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header">
                <i class="bi bi-calendar-event me-2"></i>
                {{ $jadwal->exists ? 'Edit' : 'Tambah' }} Jadwal PMB
            </div>
            <div class="card-body p-4">
                <form action="{{ $jadwal->exists ? route('admin.jadwal-pmb.update', $jadwal) : route('admin.jadwal-pmb.store') }}"
                      method="POST">
                    @csrf
                    @if($jadwal->exists) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" name="kegiatan" class="form-control @error('kegiatan') is-invalid @enderror"
                               value="{{ old('kegiatan', $jadwal->kegiatan) }}"
                               placeholder="contoh: Pendaftaran Online Gelombang I"
                               maxlength="200" required autofocus>
                        @error('kegiatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Periode <span class="text-danger">*</span></label>
                            <input type="text" name="periode" class="form-control @error('periode') is-invalid @enderror"
                                   value="{{ old('periode', $jadwal->periode) }}"
                                   placeholder="contoh: Februari – April"
                                   maxlength="100" required>
                            @error('periode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                @foreach(\App\Models\JadwalPmb::$statusOptions as $val => $opt)
                                <option value="{{ $val }}" {{ old('status', $jadwal->status) === $val ? 'selected' : '' }}>
                                    {{ $opt['label'] }}
                                </option>
                                @endforeach
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Urutan</label>
                            <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                                   value="{{ old('urutan', $jadwal->urutan ?? 0) }}"
                                   min="0" max="255">
                            <small class="text-muted">Angka terkecil tampil pertama.</small>
                            @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-8 d-flex align-items-center pt-4 mt-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                                       {{ old('is_active', $jadwal->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">Tampilkan di website</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-2"></i>Simpan
                        </button>
                        <a href="{{ route('admin.jadwal-pmb.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card card">
            <div class="card-header"><i class="bi bi-palette me-2"></i>Keterangan Status</div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-2" style="font-size:.85rem;">
                    @foreach(\App\Models\JadwalPmb::$statusOptions as $val => $opt)
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge rounded-pill {{ $opt['class'] }}" style="min-width:90px;">{{ $opt['label'] }}</span>
                        <span class="text-muted">
                            @if($val === 'buka') Pendaftaran sedang dibuka
                            @elseif($val === 'proses') Sedang dalam proses seleksi
                            @elseif($val === 'belum') Belum dimulai
                            @elseif($val === 'akan_datang') Akan segera dibuka
                            @elseif($val === 'selesai') Sudah selesai
                            @endif
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
