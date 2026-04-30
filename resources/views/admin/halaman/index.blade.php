@extends('layouts.admin')
@section('title', 'Halaman Dinamis')
@section('page-title', 'Halaman Dinamis')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <p class="text-muted mb-0" style="font-size:.875rem;">Kelola halaman konten yang dapat ditambahkan ke menu navigasi.</p>
    <a href="{{ route('admin.halaman.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-1"></i>Buat Halaman
    </a>
</div>

<div class="admin-card card">
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Judul Halaman</th>
                    <th>Slug / URL</th>
                    <th style="width:90px">Status</th>
                    <th style="width:80px">Urutan</th>
                    <th style="width:120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($halaman as $h)
                <tr>
                    <td class="text-muted" style="font-size:.8rem;">{{ $loop->iteration }}</td>
                    <td>
                        <div style="font-weight:600; color:#1a1a2e;">{{ $h->judul }}</div>
                        @if($h->meta_deskripsi)
                            <div style="font-size:.78rem; color:#aaa;">{{ Str::limit($h->meta_deskripsi, 60) }}</div>
                        @endif
                    </td>
                    <td>
                        <code style="font-size:.8rem; background:#f0f0f0; padding:2px 8px; border-radius:4px;">/halaman/{{ $h->slug }}</code>
                        @if($h->is_published)
                        <a href="{{ route('halaman.show', $h->slug) }}" target="_blank" class="ms-1 text-muted" title="Buka halaman">
                            <i class="bi bi-box-arrow-up-right" style="font-size:.8rem;"></i>
                        </a>
                        @endif
                    </td>
                    <td>
                        @if($h->is_published)
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Aktif</span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Draft</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $h->urutan }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.halaman.edit', $h) }}" class="btn btn-sm btn-outline-primary rounded-2" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.halaman.destroy', $h) }}" method="POST"
                                  onsubmit="return confirm('Hapus halaman ini?')">
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
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="bi bi-file-earmark display-5 d-block mb-2 opacity-25"></i>
                        Belum ada halaman. <a href="{{ route('admin.halaman.create') }}">Buat halaman pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
