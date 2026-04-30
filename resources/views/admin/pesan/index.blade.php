@extends('layouts.admin')
@section('title', 'Pesan Masuk')
@section('page-title', 'Pesan Masuk')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h5 class="mb-1" style="font-weight:700;">Pesan Kontak</h5><small class="text-muted">Total: {{ $pesan->total() }} pesan</small></div>
</div>

<div class="admin-card card">
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:160px;">Pengirim</th>
                    <th>Subjek</th>
                    <th>Telepon</th>
                    <th>Waktu</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesan as $p)
                <tr class="{{ !$p->is_read ? 'fw-semibold' : '' }}">
                    <td>
                        <div style="font-weight:{{ !$p->is_read ? '700' : '500' }}; color:#333;">{{ $p->nama }}</div>
                        <small class="text-muted">{{ $p->email }}</small>
                    </td>
                    <td>
                        <a href="{{ route('admin.pesan.show', $p) }}" class="text-decoration-none" style="color:inherit; font-weight:{{ !$p->is_read ? '600' : '400' }};">
                            {{ Str::limit($p->subjek, 50) }}
                        </a>
                    </td>
                    <td style="font-size:.85rem; color:#666;">{{ $p->telepon ?? '-' }}</td>
                    <td style="font-size:.8rem; color:#888;">{{ $p->created_at->diffForHumans() }}</td>
                    <td>
                        @if(!$p->is_read)
                            <span class="badge bg-danger rounded-pill">Baru</span>
                        @else
                            <span class="badge bg-secondary rounded-pill">Dibaca</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('admin.pesan.show', $p) }}" class="btn btn-sm btn-outline-primary rounded-2" title="Baca"><i class="bi bi-eye"></i></a>
                            <form action="{{ route('admin.pesan.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-2" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Tidak ada pesan masuk</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pesan->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">{{ $pesan->links() }}</div>
    @endif
</div>
@endsection
