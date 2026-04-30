@extends('layouts.admin')
@section('title', 'Kelola Pengumuman')
@section('page-title', 'Kelola Pengumuman')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1 fw-700" style="font-weight:700;">Daftar Pengumuman</h5>
        <small class="text-muted">Total: {{ $pengumuman->total() }} pengumuman</small>
    </div>
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Pengumuman
    </a>
</div>

<div class="admin-card card">
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:40%;">Judul</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Lampiran</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumuman as $p)
                <tr>
                    <td style="font-weight:600; color:#333;">{{ Str::limit($p->judul, 55) }}</td>
                    <td style="font-size:.85rem;">{{ $p->tanggal_mulai->format('d/m/Y') }}</td>
                    <td style="font-size:.85rem;">{{ $p->tanggal_selesai ? $p->tanggal_selesai->format('d/m/Y') : '-' }}</td>
                    <td>
                        @if($p->file_lampiran)
                            <a href="{{ asset('storage/'.$p->file_lampiran) }}" target="_blank" class="badge" style="background:#f0f4ff; color:#1a1a2e; text-decoration:none;"><i class="bi bi-file-earmark me-1"></i>Ada</a>
                        @else
                            <span class="text-muted" style="font-size:.82rem;">-</span>
                        @endif
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
                            <a href="{{ route('admin.pengumuman.edit', $p) }}" class="btn btn-sm btn-outline-primary rounded-2"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.pengumuman.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-2"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Belum ada pengumuman</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pengumuman->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">{{ $pengumuman->links() }}</div>
    @endif
</div>
@endsection
