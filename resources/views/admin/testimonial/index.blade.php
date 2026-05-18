@extends('layouts.admin')
@section('title', 'Testimoni Alumni')
@section('page-title', 'Testimoni Alumni')
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
        <span><i class="bi bi-chat-quote me-2"></i>Daftar Testimoni Alumni</span>
        <button type="button" class="btn btn-admin-primary btn-sm"
                onclick="document.getElementById('testiAddPanel').classList.toggle('d-none')">
            <i class="bi bi-plus-lg me-1"></i>Tambah Testimoni
        </button>
    </div>

    {{-- Add Form Panel --}}
    <div id="testiAddPanel" class="d-none border-top border-danger border-opacity-25 bg-light">
        <div class="p-4">
            <h6 class="fw-bold mb-3" style="color:#C0304A;"><i class="bi bi-plus-circle me-2"></i>Tambah Testimoni Alumni</h6>
            @if($errors->any())
            <div class="alert alert-danger mb-3 rounded-3">
                <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif
            <form action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Alumni <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="Nama lengkap alumni" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jabatan Saat Ini <span class="text-muted">(opsional)</span></label>
                        <input type="text" name="jabatan_saat_ini" class="form-control @error('jabatan_saat_ini') is-invalid @enderror"
                               value="{{ old('jabatan_saat_ini') }}" placeholder="cth: Direktur PT XYZ">
                        @error('jabatan_saat_ini')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Angkatan</label>
                        <input type="text" name="angkatan" class="form-control @error('angkatan') is-invalid @enderror"
                               value="{{ old('angkatan') }}" placeholder="2018">
                        @error('angkatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Foto <span class="text-muted">(opsional, maks 2MB)</span></label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                               accept="image/png,image/jpeg,image/jpg,image/webp">
                        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Isi Testimoni <span class="text-danger">*</span></label>
                        <textarea name="isi" class="form-control @error('isi') is-invalid @enderror"
                                  rows="3" placeholder="Tuliskan testimoni alumni mengenai program studi..." required>{{ old('isi') }}</textarea>
                        @error('isi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="addTestiIsActive"
                                   value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                            <label class="form-check-label" for="addTestiIsActive">Aktif / Tampilkan di website</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-2"></i>Simpan Testimoni
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-2"
                                onclick="document.getElementById('testiAddPanel').classList.add('d-none')">
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
                        <th style="width:55px;">Foto</th>
                        <th>Nama</th>
                        <th style="width:200px;">Jabatan Saat Ini</th>
                        <th style="width:90px;">Angkatan</th>
                        <th style="width:100px;">Status</th>
                        <th class="text-center" style="width:110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $t)
                    <tr>
                        <td>
                            @if(!empty($t->foto_url))
                                <img src="{{ $t->foto_url }}" alt="{{ $t->nama }}"
                                     style="width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #e8e8e8;"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div style="display:none; width:40px; height:40px; border-radius:50%; background:linear-gradient(135deg,#C0304A,#8B1A2E); color:#fff; font-size:.85rem; font-weight:700; align-items:center; justify-content:center; flex-shrink:0;">
                                    {{ strtoupper(substr($t->nama, 0, 1)) }}
                                </div>
                            @else
                                <div style="display:flex; width:40px; height:40px; border-radius:50%; background:linear-gradient(135deg,#C0304A,#8B1A2E); color:#fff; font-size:.85rem; font-weight:700; align-items:center; justify-content:center; flex-shrink:0;">
                                    {{ strtoupper(substr($t->nama, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:600; color:#333; margin-bottom:2px;">{{ $t->nama }}</div>
                            @if($t->isi)
                            <small class="text-muted fst-italic">"{{ Str::limit($t->isi, 60) }}"</small>
                            @endif
                        </td>
                        <td style="font-size:.84rem; color:#555;">{{ $t->jabatan_saat_ini ?? '-' }}</td>
                        <td>
                            @if($t->angkatan)
                            <span class="badge rounded-pill" style="background:#f0f4ff; color:#1a1a2e; font-size:.74rem;">
                                {{ $t->angkatan }}
                            </span>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($t->is_active)
                                <span class="badge bg-success rounded-pill">Aktif</span>
                            @else
                                <span class="badge bg-secondary rounded-pill">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-2" title="Edit"
                                        onclick="openEditTestimonial(
                                            {{ $t->id }},
                                            {{ json_encode($t->nama) }},
                                            {{ json_encode($t->jabatan_saat_ini ?? '') }},
                                            {{ json_encode($t->angkatan ?? '') }},
                                            {{ json_encode($t->isi) }},
                                            {{ $t->urutan }},
                                            {{ $t->is_active ? 1 : 0 }}
                                        )">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.testimonial.destroy', $t->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus testimoni dari {{ addslashes($t->nama) }}?')">
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
                            <i class="bi bi-chat-left-quote fs-2 d-block mb-2 opacity-40"></i>
                            Belum ada testimoni alumni. Klik "Tambah Testimoni" untuk memulai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($testimonials->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">
        {{ $testimonials->links() }}
    </div>
    @endif
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editTestimonialModal" tabindex="-1" aria-labelledby="editTestimonialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold" id="editTestimonialModalLabel">
                    <i class="bi bi-pencil-square me-2 text-danger"></i>Edit Testimoni Alumni
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editTestimonialForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Alumni <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="editTestiNama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jabatan Saat Ini <span class="text-muted">(opsional)</span></label>
                        <input type="text" name="jabatan_saat_ini" id="editTestiJabatan" class="form-control"
                               placeholder="cth: Direktur PT XYZ">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Angkatan</label>
                            <input type="text" name="angkatan" id="editTestiAngkatan" class="form-control" placeholder="2018">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" id="editTestiUrutan" class="form-control" min="0">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ganti Foto <span class="text-muted">(opsional — kosongkan jika tidak diganti, maks 2MB)</span></label>
                        <input type="file" name="foto" class="form-control" accept="image/png,image/jpeg,image/jpg,image/webp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Testimoni <span class="text-danger">*</span></label>
                        <textarea name="isi" id="editTestiIsi" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="editTestiIsActive" value="1">
                        <label class="form-check-label" for="editTestiIsActive">Aktif / Tampilkan di website</label>
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
function openEditTestimonial(id, nama, jabatan, angkatan, isi, urutan, isActive) {
    const form = document.getElementById('editTestimonialForm');
    form.action = '/admin/testimonial/' + id;

    document.getElementById('editTestiNama').value      = nama;
    document.getElementById('editTestiJabatan').value   = jabatan;
    document.getElementById('editTestiAngkatan').value  = angkatan;
    document.getElementById('editTestiIsi').value       = isi;
    document.getElementById('editTestiUrutan').value    = urutan;
    document.getElementById('editTestiIsActive').checked = isActive === 1;

    // Reset file input
    const fotoInput = form.querySelector('input[type="file"]');
    if (fotoInput) fotoInput.value = '';

    new bootstrap.Modal(document.getElementById('editTestimonialModal')).show();
}

// Re-open add panel if validation failed
@if($errors->any())
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('testiAddPanel').classList.remove('d-none');
});
@endif
</script>
@endsection
