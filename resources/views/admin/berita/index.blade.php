@extends('layouts.admin')
@section('title', 'Kelola Berita')
@section('page-title', 'Kelola Berita')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1 fw-700" style="font-weight:700;">Daftar Berita</h5>
        <small class="text-muted">Total: {{ $berita->total() }} berita</small>
    </div>
    <a href="{{ route('admin.berita.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Berita
    </a>
</div>

<div class="admin-card card">
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:40%;">Judul</th>
                    <th>Kategori</th>
                    <th>Penulis</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($berita as $b)
                <tr>
                    <td>
                        <div style="font-weight:600; color:#333; margin-bottom:2px;">{{ Str::limit($b->judul, 55) }}</div>
                        <small class="text-muted"><i class="bi bi-eye me-1"></i>{{ $b->views }} views</small>
                    </td>
                    <td><span class="badge rounded-pill" style="background:#fff5f5; color:var(--red); font-size:.75rem;">{{ $b->kategori }}</span></td>
                    <td style="color:#666; font-size:.85rem;">{{ $b->penulis }}</td>
                    <td>
                        @if($b->is_published)
                            <span class="badge bg-success rounded-pill">Terbit</span>
                        @else
                            <span class="badge bg-secondary rounded-pill">Draft</span>
                        @endif
                    </td>
                    <td style="font-size:.8rem; color:#888;">{{ $b->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            @if($b->is_published)
                            <a href="{{ route('berita.show', $b->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-2" title="Lihat"><i class="bi bi-eye"></i></a>
                            @endif
                            <a href="{{ route('admin.berita.edit', $b) }}" class="btn btn-sm btn-outline-primary rounded-2" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.berita.destroy', $b) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-2" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Belum ada berita</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($berita->hasPages())
    <div class="card-footer bg-white border-top-0 pt-0 pb-3 px-4">{{ $berita->links() }}</div>
    @endif
</div>
@endsection
