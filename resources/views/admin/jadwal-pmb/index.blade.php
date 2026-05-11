@extends('layouts.admin')
@section('title', 'Jadwal PMB')
@section('page-title', 'Jadwal PMB')

@section('content')

<div class="admin-card card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-calendar-event me-2"></i>Jadwal Penerimaan Mahasiswa Baru</span>
        <a href="{{ route('admin.jadwal-pmb.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Tambah Jadwal
        </a>
    </div>

    <div class="card-body p-0">
        @if(session('success'))
        <div class="alert alert-success m-3 mb-0 border-0 rounded-3">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table admin-table mb-0">
                <thead>
                    <tr>
                        <th style="width:40px;">No</th>
                        <th>Kegiatan</th>
                        <th style="width:180px;">Periode</th>
                        <th style="width:120px;">Status</th>
                        <th style="width:60px;">Urutan</th>
                        <th style="width:80px;">Tampil</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $i => $jadwal)
                    <tr>
                        <td class="text-muted">{{ $i + 1 }}</td>
                        <td style="font-weight:600;">{{ $jadwal->kegiatan }}</td>
                        <td class="text-muted">{{ $jadwal->periode }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $jadwal->status_class }}">
                                {{ $jadwal->status_label }}
                            </span>
                        </td>
                        <td class="text-center text-muted">{{ $jadwal->urutan }}</td>
                        <td class="text-center">
                            @if($jadwal->is_active)
                                <span class="badge bg-success rounded-pill">Aktif</span>
                            @else
                                <span class="badge bg-secondary rounded-pill">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.jadwal-pmb.edit', $jadwal) }}"
                                   class="btn btn-sm btn-outline-primary rounded-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.jadwal-pmb.destroy', $jadwal) }}" method="POST"
                                      onsubmit="return confirm('Hapus jadwal ini?')">
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
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-calendar-x fs-3 d-block mb-2 opacity-40"></i>
                            Belum ada jadwal PMB. <a href="{{ route('admin.jadwal-pmb.create') }}">Tambah sekarang</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer text-muted" style="font-size:.8rem;">
        <i class="bi bi-info-circle me-1"></i>
        Total {{ $jadwals->count() }} jadwal &bull; Urutkan berdasarkan kolom <strong>Urutan</strong> (angka terkecil tampil pertama).
    </div>
</div>

@endsection
