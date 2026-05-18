@extends('layouts.admin')
@section('title', 'Download Center')
@section('page-title', 'Download Center')
@section('content')

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
@if($errors->has('kategori'))
<div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4">
    <i class="bi bi-x-circle me-2"></i>{{ $errors->first('kategori') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">

    {{-- ── KELOLA KATEGORI ─────────────────────────────── --}}
    <div class="col-lg-4">
        <div class="admin-card card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-tags me-2"></i>Kelola Kategori</span>
                <button class="btn btn-sm btn-admin-primary" onclick="togglePanel('addKatPanel')">
                    <i class="bi bi-plus-lg me-1"></i>Tambah
                </button>
            </div>

            {{-- Add Kategori Panel --}}
            <div id="addKatPanel" class="d-none border-top bg-light p-3">
                <form action="{{ route('admin.download.kategori.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label form-label-sm">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control form-control-sm @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="cth: Formulir PMB" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label form-label-sm">Urutan</label>
                            <input type="number" name="urutan" class="form-control form-control-sm" value="{{ old('urutan', 0) }}" min="0">
                        </div>
                        <div class="col-6 d-flex align-items-end pb-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                <label class="form-check-label" style="font-size:.8rem;">Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary btn-sm px-3">Simpan</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="togglePanel('addKatPanel')">Batal</button>
                    </div>
                </form>
            </div>

            {{-- Kategori List --}}
            <div class="card-body p-0">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th class="text-center" style="width:60px;">File</th>
                            <th class="text-center" style="width:90px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $kat)
                        <tr>
                            <td>
                                <span class="fw-semibold">{{ $kat->nama }}</span>
                                @if(!$kat->is_active)
                                <span class="badge bg-secondary ms-1" style="font-size:.65rem;">Nonaktif</span>
                                @endif
                                <br><small class="text-muted">Urutan: {{ $kat->urutan }}</small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border" style="font-size:.75rem;">
                                    {{ $downloads->where('kategori', $kat->nama)->count() }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary rounded-2 me-1"
                                        onclick="openEditKat({{ $kat->id }}, '{{ addslashes($kat->nama) }}', {{ $kat->urutan }}, {{ $kat->is_active ? 1 : 0 }})">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.download.kategori.destroy', $kat->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus kategori {{ $kat->nama }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-2"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-4" style="font-size:.85rem;">Belum ada kategori.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── DAFTAR FILE ─────────────────────────────────── --}}
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-download me-2"></i>Daftar File Download</span>
                <button type="button" class="btn btn-sm btn-admin-primary" onclick="togglePanel('addPanel')">
                    <i class="bi bi-plus-lg me-1"></i>Tambah File
                </button>
            </div>

            {{-- Add File Panel --}}
            <div id="addPanel" class="d-none border-top border-danger border-opacity-25 bg-light p-4">
                @if($errors->any() && !$errors->has('kategori'))
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
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kat)
                                <option value="{{ $kat->nama }}" {{ old('kategori') === $kat->nama ? 'selected' : '' }}>
                                    {{ $kat->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                            <textarea name="deskripsi" class="form-control" rows="2"
                                      placeholder="Keterangan singkat...">{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">File <span class="text-danger">*</span></label>
                            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                            <small class="text-muted">Maks. 20MB. PDF, DOC, XLS, ZIP, dll.</small>
                            @error('file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                        </div>
                        <div class="col-md-4 d-flex align-items-end pb-1">
                            <div class="form-check form-switch">
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
                                    onclick="togglePanel('addPanel')">Batal</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Table --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table admin-table mb-0">
                        <thead>
                            <tr>
                                <th style="width:40px;">No</th>
                                <th>Judul</th>
                                <th style="width:120px;">Kategori</th>
                                <th style="width:90px;">Ukuran</th>
                                <th style="width:90px;">Status</th>
                                <th class="text-center" style="width:100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($downloads as $d)
                            <tr>
                                <td class="text-muted">{{ $downloads->firstItem() + $loop->index }}</td>
                                <td>
                                    <a href="{{ $d->file_url }}" target="_blank" download
                                       class="fw-semibold text-decoration-none" style="color:#333;">
                                        <i class="bi bi-file-earmark-arrow-down me-1 text-danger opacity-75"></i>{{ $d->judul }}
                                    </a>
                                    @if($d->deskripsi)
                                    <br><small class="text-muted">{{ Str::limit($d->deskripsi, 60) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge rounded-pill" style="background:#f0f4ff;color:#1a1a2e;font-size:.74rem;">
                                        {{ $d->kategori ?? '-' }}
                                    </span>
                                </td>
                                <td style="font-size:.83rem;color:#666;">{{ $d->ukuran ?? '-' }}</td>
                                <td>
                                    @if($d->is_active)
                                    <span class="badge bg-success rounded-pill">Aktif</span>
                                    @else
                                    <span class="badge bg-secondary rounded-pill">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <button class="btn btn-sm btn-outline-primary rounded-2"
                                                onclick="openEditDownload({{ $d->id }},'{{ addslashes($d->judul) }}','{{ addslashes($d->deskripsi ?? '') }}','{{ addslashes($d->kategori ?? '') }}',{{ $d->urutan }},{{ $d->is_active ? 1 : 0 }})">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('admin.download.destroy', $d->id) }}" method="POST"
                                              onsubmit="return confirm('Hapus file ini?')" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger rounded-2"><i class="bi bi-trash"></i></button>
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

            @if($downloads->hasPages())
            <div class="card-footer bg-white border-top-0 pb-3 px-4">
                {{ $downloads->links() }}
            </div>
            @endif
        </div>
    </div>

</div>

{{-- Modal Edit Kategori --}}
<div class="modal fade" id="editKatModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold"><i class="bi bi-tag me-2"></i>Edit Kategori</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editKatForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="ek_nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" id="ek_urutan" class="form-control" min="0">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="ek_active" value="1">
                        <label class="form-check-label">Aktif</label>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-3">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit File --}}
<div class="modal fade" id="editDownloadModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2 text-danger"></i>Edit File Download</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editDownloadForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" id="ed_judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" id="ed_kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kat)
                            <option value="{{ $kat->nama }}">{{ $kat->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi <span class="text-muted">(opsional)</span></label>
                        <textarea name="deskripsi" id="ed_deskripsi" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti File <span class="text-muted">(kosongkan jika tidak diganti)</span></label>
                        <input type="file" name="file" class="form-control">
                        <small class="text-muted">Maks. 20MB.</small>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" id="ed_urutan" class="form-control" min="0">
                        </div>
                        <div class="col-6 d-flex align-items-end pb-1">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="ed_active" value="1">
                                <label class="form-check-label">Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary"><i class="bi bi-save me-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function togglePanel(id) {
    document.getElementById(id).classList.toggle('d-none');
}

function openEditKat(id, nama, urutan, isActive) {
    document.getElementById('editKatForm').action = '/admin/download/kategori/' + id;
    document.getElementById('ek_nama').value   = nama;
    document.getElementById('ek_urutan').value = urutan;
    document.getElementById('ek_active').checked = isActive === 1;
    new bootstrap.Modal(document.getElementById('editKatModal')).show();
}

function openEditDownload(id, judul, deskripsi, kategori, urutan, isActive) {
    document.getElementById('editDownloadForm').action = '/admin/download/' + id;
    document.getElementById('ed_judul').value    = judul;
    document.getElementById('ed_deskripsi').value = deskripsi;
    document.getElementById('ed_kategori').value  = kategori;
    document.getElementById('ed_urutan').value   = urutan;
    document.getElementById('ed_active').checked = isActive === 1;
    document.querySelector('#editDownloadForm input[type="file"]').value = '';
    new bootstrap.Modal(document.getElementById('editDownloadModal')).show();
}

@if($errors->any() && !$errors->has('kategori') && !$errors->has('nama'))
document.addEventListener('DOMContentLoaded', function () {
    togglePanel('addPanel');
});
@endif
</script>
@endsection
