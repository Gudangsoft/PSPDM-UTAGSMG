@extends('layouts.admin')
@section('title', 'Edit Pengumuman')
@section('page-title', 'Edit Pengumuman')
@section('content')
<div class="mb-3"><a href="{{ route('admin.pengumuman.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header">Edit Pengumuman</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control" value="{{ old('judul', $pengumuman->judul) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Pengumuman <span class="text-danger">*</span></label>
                        <textarea name="konten" rows="6" class="form-control">{{ old('konten', $pengumuman->konten) }}</textarea>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $pengumuman->tanggal_mulai->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $pengumuman->tanggal_selesai?->format('Y-m-d')) }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File Lampiran Baru</label>
                        @if($pengumuman->file_lampiran)
                        <div class="mb-2"><a href="{{ asset('storage/'.$pengumuman->file_lampiran) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-file-earmark me-1"></i>Lihat Lampiran Saat Ini</a></div>
                        @endif
                        <input type="file" name="file_lampiran" class="form-control" accept=".pdf,.doc,.docx">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah lampiran</small>
                    </div>
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $pengumuman->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-600" for="is_active" style="font-weight:600;">Aktif</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-admin-primary w-100"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
