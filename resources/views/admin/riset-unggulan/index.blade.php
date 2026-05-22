@extends('layouts.admin')
@section('title', 'Unggulan Riset')
@section('page-title', 'Unggulan Riset')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-1" style="font-weight:700;">Unggulan Riset</h5>
        <small class="text-muted">Ditampilkan di halaman <a href="{{ route('penelitian') }}" target="_blank">/penelitian</a></small>
    </div>
    <a href="{{ route('admin.riset-unggulan.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-2"></i>Tambah Riset
    </a>
</div>

<div class="admin-card card">
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">Ikon</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th style="width:70px;">Urutan</th>
                    <th style="width:90px;">Status</th>
                    <th class="text-center" style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>
                        <div style="width:42px; height:42px; background:{{ $item->warna }}; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.1rem;">
                            <i class="bi {{ $item->icon }}"></i>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight:600; color:#333;">{{ $item->judul }}</div>
                    </td>
                    <td>
                        <small class="text-muted">{{ Str::limit($item->deskripsi, 80) }}</small>
                    </td>
                    <td>{{ $item->urutan }}</td>
                    <td>
                        @if($item->is_active)
                            <span class="badge bg-success rounded-pill">Aktif</span>
                        @else
                            <span class="badge bg-secondary rounded-pill">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('admin.riset-unggulan.edit', $item) }}" class="btn btn-sm btn-outline-primary rounded-2">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.riset-unggulan.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('Hapus unggulan riset ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-2"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-5">Belum ada data unggulan riset</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
