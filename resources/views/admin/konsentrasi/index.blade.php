@extends('layouts.admin')
@section('title', 'Konsentrasi Program Studi')
@section('page-title', 'Konsentrasi Program Studi')

@section('content')

<div class="admin-card card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-diagram-3 me-2"></i>Daftar Konsentrasi</span>
        <a href="{{ route('admin.konsentrasi.create') }}" class="btn btn-admin-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Tambah Konsentrasi
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
                        <th style="width:50px;">Urutan</th>
                        <th>Nama Konsentrasi</th>
                        <th style="width:160px;">Nama Inggris</th>
                        <th style="width:80px;">Ikon</th>
                        <th style="width:90px;">Warna</th>
                        <th style="width:80px;">Tampil</th>
                        <th style="width:100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($konsentrasis as $k)
                    <tr>
                        <td class="text-center text-muted fw-bold">{{ $k->urutan }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,{{ $k->warna_primer }},{{ $k->warna_sekunder }});display:flex;align-items:center;justify-content:center;color:white;font-size:1rem;flex-shrink:0;">
                                    <i class="bi {{ $k->ikon }}"></i>
                                </div>
                                <span style="font-weight:600;font-size:.875rem;">{{ $k->nama }}</span>
                            </div>
                        </td>
                        <td class="text-muted" style="font-size:.8rem;">{{ $k->nama_en }}</td>
                        <td><code style="font-size:.75rem;">{{ $k->ikon }}</code></td>
                        <td>
                            <div class="d-flex gap-1 align-items-center">
                                <span style="width:18px;height:18px;border-radius:4px;background:{{ $k->warna_primer }};display:inline-block;" title="{{ $k->warna_primer }}"></span>
                                <span style="width:18px;height:18px;border-radius:4px;background:{{ $k->warna_sekunder }};display:inline-block;" title="{{ $k->warna_sekunder }}"></span>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($k->is_active)
                                <span class="badge bg-success rounded-pill">Aktif</span>
                            @else
                                <span class="badge bg-secondary rounded-pill">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.konsentrasi.edit', $k) }}"
                                   class="btn btn-sm btn-outline-primary rounded-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.konsentrasi.destroy', $k) }}" method="POST"
                                      onsubmit="return confirm('Hapus konsentrasi ini?')">
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
                            Belum ada konsentrasi. <a href="{{ route('admin.konsentrasi.create') }}">Tambah sekarang</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted" style="font-size:.8rem;">
        Total {{ $konsentrasis->count() }} konsentrasi &bull; Urutan terkecil tampil pertama di halaman website.
    </div>
</div>

@endsection
