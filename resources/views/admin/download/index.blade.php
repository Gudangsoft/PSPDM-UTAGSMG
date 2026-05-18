@extends('layouts.admin')
@section('title', 'Download Center')
@section('page-title', 'Download Center')
@section('content')

{{-- Alerts --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3 mb-4">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="admin-card card">
    {{-- Card Header --}}
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-download me-2"></i>Daftar File Download</span>
        <button type="button" class="btn btn-admin-primary btn-sm" id="btnTambahFile"
                onclick="document.getElementById('addPanel').classList.toggle('d-none')">
            <i class="bi bi-plus-lg me-1"></i>Tambah File
        </button>
    </div>

    {{-- Add Form Panel --}}
    <div id="addPanel" class="d-none border-top border-danger border-opacity-25 bg-light">
        <div class="p-4">
            <h6 class="fw-bold mb-3" style="color:#C0304A;"><i class="bi bi-plus-circle me-2"></i>Tambah File Download Baru</h6>
            @if($errors->any())
            <div class="alert alert-danger mb-3 rounded-3">
                <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif
            <form action="{{ route('admin.download.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul') }}" placeholder="Nama file / dokumen" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror"
                               value="{{ old('kategori') }}" placeholder="Formulir, SK, Panduan, Umum"
                               list="kategoriSuggestions">
                        <datalist id="kategoriSuggestions">
                            <option value="Formulir">
                            <option value="SK">
                            <option value="Panduan">
                            <option value="Umum">
                        </datalist>
                        @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                  rows="2" placeholder="Keterangan singkat tentang file ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">File <span class="text-danger">*</span></label>
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                        <small class="text-muted">Maks. 20MB. PDF, DOC, XLS, ZIP, dll.</small>
                        @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="is_active" id="addIsActive"
                                   value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                            <label class="form-check-label" for="addIsActive">Aktif / Tampilkan</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-cloud-upload me-2"></i>Upload & Simpan
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-2"
                                onclick="document.getElementById('addPanel').classList.add('d-none')">
                            Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th style="width:45px;">No</th>
                        <th>Judul</th>
                        <th style="width:130px;">Kategori</th>
                        <th style="width:100px;">Ukuran</th>
                        <th style="width:100px;">Status</th>
                        <th class="text-center" style="width:110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($downloads as $d)
                    <tr>
                        <td class="text-muted">{{ $downloads->firstItem() + $loop->index }}</td>
                        <td>
                            <a href="{{ $d->file_url }}" target="_blank" download
                               class="text-decoration-none fw-semibold" style="color:#333;"
                               title="Unduh file">
                                <i class="bi bi-file-earmark-arrow-down me-1 text-danger opacity-75"></i>
                                {{ $d->judul }}
                            </a>
                            @if($d->deskripsi)
                            <br><small class="text-muted">{{ Str::limit($d->deskripsi, 60) }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge rounded-pill" style="background:#f0f4ff; color:#1a1a2e; font-size:.74rem;">
                                {{ $d->kategori ?? '-' }}
                            </span>
                        </td>
                        <td style="font-size:.83rem; color:#666;">{{ $d->ukuran ?? '-' }}</td>
                        <td>
                            @if($d->is_active)
                                <span class="badge bg-success rounded-pill">Aktif</span>
                            @else
                                <span class="badge bg-secondary rounded-pill">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-2" title="Edit"
                                        onclick="openEditDownload(
                                            {{ $d->id }},
                                            '{{ addslashes($d->judul) }}',
                                            '{{ addslashes($d->deskripsi ?? '') }}',
                                            '{{ addslashes($d->kategori ?? '') }}',
                                            '{{ addslashes($d->ukuran ?? '') }}',
                                            {{ $d->urutan }},
                                            {{ $d->is_active ? 1 : 0 }}
                                        )">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.download.destroy', $d->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus file download ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-2" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-folder2-open fs-2 d-block mb-2 opacity-40"></i>
                            Belum ada file download.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($downloads->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">
        {{ $downloads->links() }}
    </div>
    @endif
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editDownloadModal" tabindex="-1" aria-labelledby="editDownloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold" id="editDownloadModalLabel">
                    <i class="bi bi-pencil-square me-2 text-danger"></i>Edit File Download
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editDownloadForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="editDownloadJudul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                        <textarea name="deskripsi" id="editDownloadDeskripsi" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti File <span class="text-muted">(opsional — kosongkan jika tidak diganti)</span></label>
                        <input type="file" name="file" class="form-control">
                        <small class="text-muted">Maks. 20MB. Biarkan kosong untuk mempertahankan file lama.</small>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <input type="text" name="kategori" id="editDownloadKategori" class="form-control"
                                   placeholder="Formulir, SK, Panduan, Umum" list="editKategoriSuggestions">
                            <datalist id="editKategoriSuggestions">
                                <option value="Formulir">
                                <option value="SK">
                                <option value="Panduan">
                                <option value="Umum">
                            </datalist>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" id="editDownloadUrutan" class="form-control" min="0">
                        </div>
                    </div>
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="editDownloadIsActive" value="1">
                        <label class="form-check-label" for="editDownloadIsActive">Aktif / Tampilkan</label>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary">
                        <i class="bi bi-save me-1"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openEditDownload(id, judul, deskripsi, kategori, ukuran, urutan, isActive) {
    const form = document.getElementById('editDownloadForm');
    form.action = '/admin/download/' + id;

    document.getElementById('editDownloadJudul').value    = judul;
    document.getElementById('editDownloadDeskripsi').value = deskripsi;
    document.getElementById('editDownloadKategori').value  = kategori;
    document.getElementById('editDownloadUrutan').value    = urutan;
    document.getElementById('editDownloadIsActive').checked = isActive === 1;

    // Reset file input
    const fileInput = form.querySelector('input[type="file"]');
    if (fileInput) fileInput.value = '';

    new bootstrap.Modal(document.getElementById('editDownloadModal')).show();
}

// Re-open add panel if validation failed (errors exist)
@if($errors->any() && old('_form') !== 'edit')
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('addPanel').classList.remove('d-none');
});
@endif
</script>
@endsection
