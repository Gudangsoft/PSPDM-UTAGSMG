@extends('layouts.admin')
@section('title', 'Publikasi & Penelitian')
@section('page-title', 'Publikasi & Penelitian')

@section('content')

@php $currentYear = date('Y'); @endphp

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3 mb-4">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4">
    <i class="bi bi-x-circle me-2"></i>{{ $errors->first() }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1" style="font-weight:700;">Daftar Publikasi & Penelitian</h5>
        <small class="text-muted">Total: {{ $publikasis->total() }} publikasi</small>
    </div>
    <button class="btn btn-admin-primary" onclick="toggleAddForm()">
        <i class="bi bi-plus-lg me-2"></i>Tambah Publikasi
    </button>
</div>

{{-- Add Form Panel --}}
<div id="addFormPanel" class="d-none mb-4">
    <div class="admin-card card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="bi bi-journal-plus me-2"></i>Tambah Publikasi Baru</span>
            <button type="button" class="btn-close" onclick="toggleAddForm()"></button>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.publikasi.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul') }}" placeholder="Judul publikasi / penelitian" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Penulis <span class="text-danger">*</span></label>
                        <input type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror"
                               value="{{ old('penulis') }}" placeholder="Nama penulis / peneliti" required>
                        @error('penulis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jurnal / Penerbit</label>
                        <input type="text" name="jurnal_penerbit" class="form-control"
                               value="{{ old('jurnal_penerbit') }}" placeholder="Nama jurnal atau penerbit">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tahun <span class="text-danger">*</span></label>
                        <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                               value="{{ old('tahun', $currentYear) }}"
                               min="1990" max="{{ $currentYear + 1 }}" required>
                        @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tipe <span class="text-danger">*</span></label>
                        <select name="tipe" class="form-select @error('tipe') is-invalid @enderror" required>
                            <option value="jurnal"    {{ old('tipe') === 'jurnal'    ? 'selected' : '' }}>Jurnal</option>
                            <option value="buku"      {{ old('tipe') === 'buku'      ? 'selected' : '' }}>Buku</option>
                            <option value="prosiding" {{ old('tipe') === 'prosiding' ? 'selected' : '' }}>Prosiding</option>
                            <option value="lainnya"   {{ old('tipe') === 'lainnya'   ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('tipe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">URL / DOI Link</label>
                        <input type="url" name="url" class="form-control"
                               value="{{ old('url') }}" placeholder="https://doi.org/... atau URL publikasi">
                    </div>
                    <div class="col-12 d-flex align-items-center gap-3 pt-1">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="add_is_active"
                                   value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="add_is_active">Tampilkan di website</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-2"></i>Simpan Publikasi
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-2" onclick="toggleAddForm()">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="admin-card card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th style="width:48px;">No</th>
                        <th>Judul</th>
                        <th style="width:160px;">Penulis</th>
                        <th style="width:160px;">Jurnal / Penerbit</th>
                        <th style="width:70px;">Tahun</th>
                        <th style="width:100px;">Tipe</th>
                        <th style="width:90px;">Status</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($publikasis as $p)
                    <tr>
                        <td class="text-muted">{{ $publikasis->firstItem() + $loop->index }}</td>
                        <td>
                            @if($p->url)
                                <a href="{{ $p->url }}" target="_blank" rel="noopener noreferrer"
                                   class="text-decoration-none" style="font-weight:600; color:#1a1a2e;">
                                    {{ Str::limit($p->judul, 65) }}
                                    <i class="bi bi-box-arrow-up-right ms-1" style="font-size:.75rem; color:#888;"></i>
                                </a>
                            @else
                                <span style="font-weight:600; color:#333;">{{ Str::limit($p->judul, 65) }}</span>
                            @endif
                        </td>
                        <td style="font-size:.85rem; color:#555;">{{ Str::limit($p->penulis, 30) }}</td>
                        <td style="font-size:.82rem; color:#666;">{{ $p->jurnal_penerbit ? Str::limit($p->jurnal_penerbit, 30) : '-' }}</td>
                        <td class="text-center" style="font-size:.88rem; font-weight:600;">{{ $p->tahun }}</td>
                        <td>
                            @php
                                $tipeBadge = match($p->tipe) {
                                    'jurnal'    => ['bg' => '#eff6ff', 'color' => '#1d4ed8', 'label' => 'Jurnal'],
                                    'buku'      => ['bg' => '#f0fdf4', 'color' => '#15803d', 'label' => 'Buku'],
                                    'prosiding' => ['bg' => '#fff7ed', 'color' => '#c2410c', 'label' => 'Prosiding'],
                                    default     => ['bg' => '#f3f4f6', 'color' => '#6b7280', 'label' => ucfirst($p->tipe)],
                                };
                            @endphp
                            <span class="badge rounded-pill" style="background:{{ $tipeBadge['bg'] }}; color:{{ $tipeBadge['color'] }}; font-size:.76rem; border:1px solid {{ $tipeBadge['color'] }}33;">
                                {{ $tipeBadge['label'] }}
                            </span>
                        </td>
                        <td>
                            @if($p->is_active)
                                <span class="badge bg-success rounded-pill">Aktif</span>
                            @else
                                <span class="badge bg-secondary rounded-pill">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <button class="btn btn-sm btn-outline-primary rounded-2" title="Edit"
                                        onclick="openEditPublikasi(
                                            {{ $p->id }},
                                            '{{ addslashes($p->judul) }}',
                                            '{{ addslashes($p->penulis) }}',
                                            '{{ addslashes($p->jurnal_penerbit ?? '') }}',
                                            {{ $p->tahun }},
                                            '{{ $p->tipe }}',
                                            '{{ addslashes($p->url ?? '') }}',
                                            {{ $p->is_active ? 1 : 0 }}
                                        )">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.publikasi.destroy', $p->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus publikasi ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-2" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-journal-x fs-2 d-block mb-2 opacity-40"></i>
                            Belum ada data publikasi. <button class="btn btn-link p-0 align-baseline" onclick="toggleAddForm()">Tambah sekarang</button>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($publikasis->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">{{ $publikasis->links() }}</div>
    @endif
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editPublikasiModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Publikasi</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPublikasiForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="judul" id="ep_judul" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Penulis <span class="text-danger">*</span></label>
                            <input type="text" name="penulis" id="ep_penulis" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jurnal / Penerbit</label>
                            <input type="text" name="jurnal_penerbit" id="ep_jurnal" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tahun <span class="text-danger">*</span></label>
                            <input type="number" name="tahun" id="ep_tahun" class="form-control"
                                   min="1990" max="{{ $currentYear + 1 }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipe <span class="text-danger">*</span></label>
                            <select name="tipe" id="ep_tipe" class="form-select" required>
                                <option value="jurnal">Jurnal</option>
                                <option value="buku">Buku</option>
                                <option value="prosiding">Prosiding</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">URL / DOI Link</label>
                            <input type="url" name="url" id="ep_url" class="form-control" placeholder="https://...">
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="ep_is_active" value="1">
                                <label class="form-check-label" for="ep_is_active">Tampilkan di website</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary px-4">
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
function toggleAddForm() {
    const panel = document.getElementById('addFormPanel');
    panel.classList.toggle('d-none');
    if (!panel.classList.contains('d-none')) {
        panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

function openEditPublikasi(id, judul, penulis, jurnal, tahun, tipe, url, isActive) {
    const form = document.getElementById('editPublikasiForm');
    form.action = '/admin/publikasi/' + id;
    document.getElementById('ep_judul').value    = judul;
    document.getElementById('ep_penulis').value  = penulis;
    document.getElementById('ep_jurnal').value   = jurnal;
    document.getElementById('ep_tahun').value    = tahun;
    document.getElementById('ep_tipe').value     = tipe;
    document.getElementById('ep_url').value      = url;
    document.getElementById('ep_is_active').checked = isActive === 1;
    new bootstrap.Modal(document.getElementById('editPublikasiModal')).show();
}

// Auto-open add form if there are validation errors
@if($errors->any())
document.addEventListener('DOMContentLoaded', function () {
    toggleAddForm();
});
@endif
</script>
@endsection
