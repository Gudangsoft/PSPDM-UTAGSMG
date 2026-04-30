@extends('layouts.admin')
@section('title', 'Kelola Dosen')
@section('page-title', 'Kelola Dosen & Staf')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div><h5 class="mb-1 fw-700" style="font-weight:700;">Data Dosen & Staf</h5><small class="text-muted">Total: {{ $dosen->total() }} orang</small></div>
    <a href="{{ route('admin.dosen.create') }}" class="btn btn-admin-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Dosen</a>
</div>

<div class="admin-card card">
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:60px;">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Konsentrasi</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dosen as $d)
                <tr>
                    <td>
                        <img src="{{ $d->foto_url }}" alt="" style="width:42px; height:42px; border-radius:50%; object-fit:cover;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($d->nama) }}&background=CC0000&color=fff&size=42'">
                    </td>
                    <td>
                        <div style="font-weight:600; color:#333; margin-bottom:2px;">{{ $d->nama }}</div>
                        @if($d->nidn)<small class="text-muted">NIDN: {{ $d->nidn }}</small>@endif
                    </td>
                    <td style="font-size:.85rem; color:#555;">{{ $d->jabatan }}</td>
                    <td>
                        @if($d->konsentrasi)
                        <span class="badge rounded-pill" style="background:#fff5f5; color:var(--red); font-size:.72rem;">{{ Str::limit($d->konsentrasi, 25) }}</span>
                        @else<span class="text-muted">-</span>@endif
                    </td>
                    <td>{{ $d->urutan }}</td>
                    <td>
                        @if($d->is_active)<span class="badge bg-success rounded-pill">Aktif</span>
                        @else<span class="badge bg-secondary rounded-pill">Nonaktif</span>@endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('admin.dosen.edit', $d) }}" class="btn btn-sm btn-outline-primary rounded-2"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.dosen.destroy', $d) }}" method="POST" onsubmit="return confirm('Hapus data dosen ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-2"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-5">Belum ada data dosen</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($dosen->hasPages())
    <div class="card-footer bg-white border-top-0 pb-3 px-4">{{ $dosen->links() }}</div>
    @endif
</div>
@endsection
