@extends('layouts.admin')
@section('title', 'Buat Album')
@section('page-title', 'Buat Album')
@section('content')

<div class="mb-3">
    <a href="{{ route('admin.album.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="admin-card card">
            <div class="card-header">Form Buat Album</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.album.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Album <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="cth: Wisuda 2025">
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" class="form-control"
                                  placeholder="Keterangan singkat album...">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                   id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">Tampilkan Album</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-admin-primary w-100">
                        <i class="bi bi-folder-plus me-2"></i>Buat Album
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
