@extends('layouts.admin')
@section('title', 'Kelola Galeri')
@section('page-title', 'Kelola Galeri')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h5 class="mb-1 fw-700" style="font-weight:700;">Galeri Foto</h5><small class="text-muted">Total: {{ $galeri->total() }} foto</small></div>
    <a href="{{ route('admin.galeri.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-2"></i>Upload Foto</a>
</div>

<div class="admin-card card">
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:80px;">Foto</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galeri as $g)
                <tr>
                    <td><img src="{{ $g->gambar_url }}" alt="" style="width:60px; height:45px; object-fit:cover; border-radius:6px;" onerror="this.src='https://via.placeholder.com/60x45/CC0000/fff?text=G'"></td>
                    <td style="font-weight:600; color:#333;">{{ Str::limit($g->judul, 45) }}</td>
                    <td><span class="badge rounded-pill" style="background:#f0f4ff; color:#1a1a2e; font-size:.75rem;">{{ $g->kategori }}</span></td>
                    <td>{{ $g->urutan }}</td>
                    <td>
                        @if($g->is_active)<span class="badge bg-success rounded-pill">Aktif</span>
                        @else<span class="badge bg-secondary rounded-pill">Nonaktif</span>@endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('admin.galeri.edit', $g) }}" class="btn btn-sm btn-outline-primary rounded-2"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.galeri.destroy', $g) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-2"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Belum ada foto</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($galeri->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">{{ $galeri->links() }}</div>
    @endif
</div>
@endsection
