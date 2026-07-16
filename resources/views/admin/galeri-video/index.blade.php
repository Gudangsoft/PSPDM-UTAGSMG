@extends('layouts.admin')
@section('title', 'Kelola Galeri Video')
@section('page-title', 'Kelola Galeri Video')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h5 class="mb-1 fw-700" style="font-weight:700;">Galeri Video</h5><small class="text-muted">Total: {{ $videos->total() }} video &bull; YouTube, Instagram &amp; TikTok</small></div>
    <a href="{{ route('admin.galeri-video.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Video</a>
</div>

<div class="admin-card card">
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">Platform</th>
                    <th>Judul</th>
                    <th>Link</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($videos as $v)
                <tr>
                    <td><i class="bi {{ $v->platform_icon }}" style="font-size:1.3rem;"></i></td>
                    <td style="font-weight:600; color:#333;">{{ Str::limit($v->judul, 45) }}</td>
                    <td><a href="{{ $v->url }}" target="_blank" rel="noopener" style="font-size:.8rem;">{{ Str::limit($v->url, 40) }}</a></td>
                    <td>{{ $v->urutan }}</td>
                    <td>
                        @if($v->is_active)<span class="badge bg-success rounded-pill">Aktif</span>
                        @else<span class="badge bg-secondary rounded-pill">Nonaktif</span>@endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('admin.galeri-video.edit', $v) }}" class="btn btn-sm btn-outline-primary rounded-2"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.galeri-video.destroy', $v) }}" method="POST" onsubmit="return confirm('Hapus video ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-2"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Belum ada video</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($videos->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">{{ $videos->links() }}</div>
    @endif
</div>
@endsection
