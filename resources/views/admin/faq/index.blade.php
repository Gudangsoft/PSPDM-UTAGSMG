@extends('layouts.admin')
@section('title', 'FAQ (Pertanyaan Umum)')
@section('page-title', 'FAQ (Pertanyaan Umum)')
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
        <span><i class="bi bi-question-circle me-2"></i>Daftar FAQ</span>
        <button type="button" class="btn btn-admin-primary btn-sm"
                onclick="document.getElementById('faqAddPanel').classList.toggle('d-none')">
            <i class="bi bi-plus-lg me-1"></i>Tambah FAQ
        </button>
    </div>

    {{-- Add Form Panel --}}
    <div id="faqAddPanel" class="d-none border-top border-danger border-opacity-25 bg-light">
        <div class="p-4">
            <h6 class="fw-bold mb-3" style="color:#C0304A;"><i class="bi bi-plus-circle me-2"></i>Tambah FAQ Baru</h6>
            @if($errors->any())
            <div class="alert alert-danger mb-3 rounded-3">
                <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif
            <form action="{{ route('admin.faq.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                        <textarea name="pertanyaan" class="form-control @error('pertanyaan') is-invalid @enderror"
                                  rows="2" placeholder="Tuliskan pertanyaan yang sering diajukan..." required>{{ old('pertanyaan') }}</textarea>
                        @error('pertanyaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Jawaban <span class="text-danger">*</span></label>
                        <textarea name="jawaban" class="form-control @error('jawaban') is-invalid @enderror"
                                  rows="4" placeholder="Tuliskan jawaban lengkap..." required>{{ old('jawaban') }}</textarea>
                        @error('jawaban')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kategori <span class="text-muted">(opsional)</span></label>
                        <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror"
                               value="{{ old('kategori') }}" placeholder="cth: Pendaftaran, Akademik">
                        @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="is_active" id="addFaqIsActive"
                                   value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                            <label class="form-check-label" for="addFaqIsActive">Aktif / Tampilkan</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-2"></i>Simpan FAQ
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-2"
                                onclick="document.getElementById('faqAddPanel').classList.add('d-none')">
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
                        <th>Pertanyaan</th>
                        <th style="width:140px;">Kategori</th>
                        <th style="width:100px;">Status</th>
                        <th class="text-center" style="width:110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                    <tr>
                        <td class="text-muted">{{ $faqs->firstItem() + $loop->index }}</td>
                        <td>
                            <div style="font-weight:600; color:#333; margin-bottom:2px;">
                                {{ Str::limit($faq->pertanyaan, 80) }}
                            </div>
                            @if($faq->jawaban)
                            <small class="text-muted">{{ Str::limit($faq->jawaban, 70) }}</small>
                            @endif
                        </td>
                        <td>
                            @if($faq->kategori)
                            <span class="badge rounded-pill" style="background:#f0f4ff; color:#1a1a2e; font-size:.74rem;">
                                {{ $faq->kategori }}
                            </span>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($faq->is_active)
                                <span class="badge bg-success rounded-pill">Aktif</span>
                            @else
                                <span class="badge bg-secondary rounded-pill">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-2" title="Edit"
                                        onclick="openEditFaq(
                                            {{ $faq->id }},
                                            {{ json_encode($faq->pertanyaan) }},
                                            {{ json_encode($faq->jawaban) }},
                                            '{{ addslashes($faq->kategori ?? '') }}',
                                            {{ $faq->urutan }},
                                            {{ $faq->is_active ? 1 : 0 }}
                                        )">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus FAQ ini?')">
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
                        <td colspan="5" class="text-center text-muted py-5">
                            <i class="bi bi-question-circle fs-2 d-block mb-2 opacity-40"></i>
                            Belum ada FAQ. Klik "Tambah FAQ" untuk menambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($faqs->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">
        {{ $faqs->links() }}
    </div>
    @endif
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editFaqModal" tabindex="-1" aria-labelledby="editFaqModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold" id="editFaqModalLabel">
                    <i class="bi bi-pencil-square me-2 text-danger"></i>Edit FAQ
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editFaqForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                        <textarea name="pertanyaan" id="editFaqPertanyaan" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jawaban <span class="text-danger">*</span></label>
                        <textarea name="jawaban" id="editFaqJawaban" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label">Kategori <span class="text-muted">(opsional)</span></label>
                            <input type="text" name="kategori" id="editFaqKategori" class="form-control"
                                   placeholder="cth: Pendaftaran, Akademik">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Urutan</label>
                            <input type="number" name="urutan" id="editFaqUrutan" class="form-control" min="0">
                        </div>
                    </div>
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="editFaqIsActive" value="1">
                        <label class="form-check-label" for="editFaqIsActive">Aktif / Tampilkan</label>
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
function openEditFaq(id, pertanyaan, jawaban, kategori, urutan, isActive) {
    const form = document.getElementById('editFaqForm');
    form.action = '/admin/faq/' + id;

    document.getElementById('editFaqPertanyaan').value  = pertanyaan;
    document.getElementById('editFaqJawaban').value     = jawaban;
    document.getElementById('editFaqKategori').value    = kategori;
    document.getElementById('editFaqUrutan').value      = urutan;
    document.getElementById('editFaqIsActive').checked  = isActive === 1;

    new bootstrap.Modal(document.getElementById('editFaqModal')).show();
}

// Re-open add panel if validation failed
@if($errors->any())
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('faqAddPanel').classList.remove('d-none');
});
@endif
</script>
@endsection
