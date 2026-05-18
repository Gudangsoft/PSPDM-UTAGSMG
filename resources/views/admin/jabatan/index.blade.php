@extends('layouts.admin')
@section('title', 'Jabatan Akademik')
@section('page-title', 'Jabatan Akademik')
@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3 mb-4">
    {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-4">

    {{-- Form Tambah --}}
    <div class="col-lg-4">
        <div class="admin-card card">
            <div class="card-header fw-bold">Tambah Jabatan Baru</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.jabatan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="cth: Lektor Kepala">
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-admin-primary w-100">
                        <i class="bi bi-plus-lg me-2"></i>Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Daftar Jabatan --}}
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fw-bold">Daftar Jabatan</span>
                <span class="badge" style="background:#f0f4ff;color:#333;">{{ $jabatans->count() }} jabatan</span>
            </div>
            <div class="card-body p-0">
                <table class="table admin-table mb-0">
                    <thead>
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Nama Jabatan</th>
                            <th style="width:80px;">Urutan</th>
                            <th style="width:90px;">Status</th>
                            <th class="text-center" style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jabatans as $j)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td style="font-weight:600;">{{ $j->nama }}</td>
                            <td>{{ $j->urutan }}</td>
                            <td>
                                @if($j->is_active)
                                <span class="badge bg-success rounded-pill">Aktif</span>
                                @else
                                <span class="badge bg-secondary rounded-pill">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <button class="btn btn-sm btn-outline-primary rounded-2"
                                            onclick="openEdit({{ $j->id }}, '{{ addslashes($j->nama) }}', {{ $j->urutan }}, {{ $j->is_active ? 1 : 0 }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('admin.jabatan.destroy', $j) }}" method="POST"
                                          onsubmit="return confirm('Hapus jabatan ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger rounded-2">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada jabatan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold">Edit Jabatan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Jabatan</label>
                        <input type="text" name="nama" id="editNama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" id="editUrutan" class="form-control" min="0">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="editAktif" value="1">
                        <label class="form-check-label" for="editAktif">Aktif</label>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-admin-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openEdit(id, nama, urutan, aktif) {
    document.getElementById('editForm').action = '/admin/jabatan/' + id;
    document.getElementById('editNama').value   = nama;
    document.getElementById('editUrutan').value  = urutan;
    document.getElementById('editAktif').checked = aktif === 1;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}
</script>
@endsection
