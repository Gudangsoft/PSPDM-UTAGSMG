@extends('layouts.admin')
@section('title', 'Tambah Pengumuman')
@section('page-title', 'Tambah Pengumuman')
@section('content')
<div class="mb-3"><a href="{{ route('admin.pengumuman.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header">Form Pengumuman</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}">
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea name="konten" rows="6" class="form-control @error('konten') is-invalid @enderror">{{ old('konten') }}</textarea>
                        @error('konten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai', date('Y-m-d')) }}">
                            @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}">
                            <small class="text-muted">Kosongkan jika tidak ada batas waktu</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Lampiran (PDF/DOC)</label>
                        <input type="file" name="file_lampiran" class="form-control" accept=".pdf,.doc,.docx">
                        <small class="text-muted">Maks 5MB</small>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-600" for="is_active" style="font-weight:600;">Aktifkan Pengumuman</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-admin-primary w-100"><i class="bi bi-save me-2"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
