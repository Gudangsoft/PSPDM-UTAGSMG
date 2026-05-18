@extends('layouts.admin')
@section('title', 'Agenda & Kegiatan')
@section('page-title', 'Agenda & Kegiatan')

@section('content')

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
        <h5 class="mb-1" style="font-weight:700;">Daftar Agenda & Kegiatan</h5>
        <small class="text-muted">Total: {{ $agendas->total() }} agenda</small>
    </div>
    <button class="btn btn-admin-primary" onclick="toggleAddForm()">
        <i class="bi bi-plus-lg me-2"></i>Tambah Agenda
    </button>
</div>

{{-- Add Form Panel --}}
<div id="addFormPanel" class="d-none mb-4">
    <div class="admin-card card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <span><i class="bi bi-calendar-plus me-2"></i>Tambah Agenda Baru</span>
            <button type="button" class="btn-close" onclick="toggleAddForm()"></button>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.agenda.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul') }}" placeholder="Judul kegiatan / agenda" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"
                                  placeholder="Deskripsi singkat agenda (opsional)">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                               value="{{ old('tanggal_mulai') }}" required>
                        @error('tanggal_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" class="form-control"
                               value="{{ old('tanggal_selesai') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Waktu</label>
                        <input type="text" name="waktu" class="form-control"
                               value="{{ old('waktu') }}" placeholder="08.00 – 12.00 WIB">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control"
                               value="{{ old('lokasi') }}" placeholder="Nama tempat / ruangan / link online">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="is_active" id="add_is_active"
                                   value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="add_is_active">Tampilkan di website</label>
                        </div>
                    </div>
                    <div class="col-12 d-flex gap-2 pt-1">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-2"></i>Simpan Agenda
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
                        <th style="width:200px;">Tanggal</th>
                        <th style="width:150px;">Waktu</th>
                        <th style="width:180px;">Lokasi</th>
                        <th style="width:110px;">Status</th>
                        <th class="text-center" style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agendas as $a)
                    @php
                        $today = \Carbon\Carbon::today();
                        $mulai = \Carbon\Carbon::parse($a->tanggal_mulai);
                        $isMendatang = $mulai->gte($today);
                    @endphp
                    <tr>
                        <td class="text-muted">{{ $agendas->firstItem() + $loop->index }}</td>
                        <td>
                            <div style="font-weight:600; color:#333;">{{ Str::limit($a->judul, 60) }}</div>
                            @if($a->deskripsi)
                            <small class="text-muted">{{ Str::limit($a->deskripsi, 70) }}</small>
                            @endif
                        </td>
                        <td>
                            @if($isMendatang)
                                <span class="badge rounded-pill" style="background:#d1fae5; color:#065f46; font-size:.78rem;">
                                    <i class="bi bi-calendar-check me-1"></i>{{ $mulai->format('d M Y') }}
                                    @if($a->tanggal_selesai && $a->tanggal_selesai != $a->tanggal_mulai)
                                        &ndash; {{ \Carbon\Carbon::parse($a->tanggal_selesai)->format('d M Y') }}
                                    @endif
                                </span>
                            @else
                                <span class="badge rounded-pill" style="background:#f3f4f6; color:#6b7280; font-size:.78rem;">
                                    <i class="bi bi-calendar-x me-1"></i>{{ $mulai->format('d M Y') }}
                                    @if($a->tanggal_selesai && $a->tanggal_selesai != $a->tanggal_mulai)
                                        &ndash; {{ \Carbon\Carbon::parse($a->tanggal_selesai)->format('d M Y') }}
                                    @endif
                                </span>
                            @endif
                        </td>
                        <td style="font-size:.85rem; color:#555;">{{ $a->waktu ?? '-' }}</td>
                        <td style="font-size:.85rem; color:#555;">{{ $a->lokasi ? Str::limit($a->lokasi, 30) : '-' }}</td>
                        <td>
                            @if($a->is_active)
                                <span class="badge bg-success rounded-pill">Aktif</span>
                            @else
                                <span class="badge bg-secondary rounded-pill">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center">
                                <button class="btn btn-sm btn-outline-primary rounded-2" title="Edit"
                                        onclick="openEditAgenda(
                                            {{ $a->id }},
                                            '{{ addslashes($a->judul) }}',
                                            '{{ addslashes($a->deskripsi ?? '') }}',
                                            '{{ $a->tanggal_mulai }}',
                                            '{{ $a->tanggal_selesai ?? '' }}',
                                            '{{ addslashes($a->waktu ?? '') }}',
                                            '{{ addslashes($a->lokasi ?? '') }}',
                                            {{ $a->is_active ? 1 : 0 }}
                                        )">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.agenda.destroy', $a->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus agenda ini?')">
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
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-calendar-x fs-2 d-block mb-2 opacity-40"></i>
                            Belum ada agenda. <button class="btn btn-link p-0 align-baseline" onclick="toggleAddForm()">Tambah sekarang</button>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($agendas->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">{{ $agendas->links() }}</div>
    @endif
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editAgendaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit Agenda</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editAgendaForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" name="judul" id="ea_judul" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="ea_deskripsi" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_mulai" id="ea_tanggal_mulai" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="ea_tanggal_selesai" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Waktu</label>
                            <input type="text" name="waktu" id="ea_waktu" class="form-control" placeholder="08.00 – 12.00 WIB">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" id="ea_lokasi" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="ea_is_active" value="1">
                                <label class="form-check-label" for="ea_is_active">Tampilkan di website</label>
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

function openEditAgenda(id, judul, deskripsi, tanggalMulai, tanggalSelesai, waktu, lokasi, isActive) {
    const form = document.getElementById('editAgendaForm');
    form.action = '/admin/agenda/' + id;
    document.getElementById('ea_judul').value           = judul;
    document.getElementById('ea_deskripsi').value       = deskripsi;
    document.getElementById('ea_tanggal_mulai').value   = tanggalMulai;
    document.getElementById('ea_tanggal_selesai').value = tanggalSelesai;
    document.getElementById('ea_waktu').value           = waktu;
    document.getElementById('ea_lokasi').value          = lokasi;
    document.getElementById('ea_is_active').checked     = isActive === 1;
    new bootstrap.Modal(document.getElementById('editAgendaModal')).show();
}

// Auto-open add form if there are validation errors
@if($errors->any())
document.addEventListener('DOMContentLoaded', function () {
    toggleAddForm();
});
@endif
</script>
@endsection
