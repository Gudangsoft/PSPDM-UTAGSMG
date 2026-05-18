@extends('layouts.admin')
@section('title', 'Kelola Album')
@section('page-title', 'Kelola Album')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1 fw-bold">Album Galeri</h5>
        <small class="text-muted">Total: {{ $albums->total() }} album</small>
    </div>
    <a href="{{ route('admin.album.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-2"></i>Buat Album
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3 mb-4">
    {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row g-3">
    @forelse($albums as $album)
    <div class="col-md-4 col-lg-3">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
            <div style="height:160px; overflow:hidden; position:relative; background:#f5f5f5;">
                <img src="{{ $album->cover_url }}" alt="{{ $album->nama }}"
                     style="width:100%; height:100%; object-fit:cover;"
                     onerror="this.src='https://via.placeholder.com/400x300/CC0000/fff?text=Album'">
                <div style="position:absolute; top:8px; right:8px;">
                    @if($album->is_active)
                    <span class="badge bg-success">Aktif</span>
                    @else
                    <span class="badge bg-secondary">Nonaktif</span>
                    @endif
                </div>
                <div style="position:absolute; bottom:8px; left:8px;">
                    <span class="badge" style="background:rgba(0,0,0,.6); color:white;">
                        <i class="bi bi-images me-1"></i>{{ $album->galeri_count }} foto
                    </span>
                </div>
            </div>
            <div class="card-body p-3">
                <h6 class="fw-bold mb-1" style="font-size:.9rem;">{{ Str::limit($album->nama, 40) }}</h6>
                @if($album->deskripsi)
                <p class="text-muted mb-2" style="font-size:.78rem;">{{ Str::limit($album->deskripsi, 60) }}</p>
                @endif
                <div class="d-flex gap-1 mt-2">
                    <a href="{{ route('admin.album.edit', $album) }}" class="btn btn-sm btn-outline-primary rounded-2 flex-fill">
                        <i class="bi bi-pencil me-1"></i>Kelola
                    </a>
                    <form action="{{ route('admin.album.destroy', $album) }}" method="POST"
                          onsubmit="return confirm('Hapus album beserta semua foto di dalamnya?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger rounded-2">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5 text-muted">
                <i class="bi bi-folder2-open" style="font-size:3rem; opacity:.3;"></i>
                <p class="mt-3">Belum ada album. <a href="{{ route('admin.album.create') }}">Buat album pertama</a></p>
            </div>
        </div>
    </div>
    @endforelse
</div>

@if($albums->hasPages())
<div class="mt-4">{{ $albums->links() }}</div>
@endif

@endsection
