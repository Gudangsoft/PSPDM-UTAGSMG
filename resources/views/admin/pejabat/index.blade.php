@extends('layouts.admin')
@section('title', 'Struktur Pejabat')
@section('page-title', 'Struktur & Pejabat')
@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- KATA PEMBUKA --}}
<div class="admin-card card mb-4">
    <div class="card-header d-flex align-items-center gap-2">
        <i class="bi bi-text-paragraph" style="color:var(--red);"></i>
        <span style="font-weight:600;">Kata Pembuka Halaman Struktur</span>
        <span class="text-muted ms-1" style="font-size:.8rem;">— teks yang tampil di atas daftar pejabat</span>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('admin.pejabat.kata-pembuka') }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="kata_pembuka" rows="4" class="form-control"
                          placeholder="Tuliskan kata pengantar atau deskripsi singkat tentang struktur organisasi program studi...">{{ old('kata_pembuka', $kataPembuka) }}</textarea>
                <small class="text-muted">Teks ini akan tampil di halaman publik /struktur, di atas daftar pejabat. Kosongkan jika tidak ingin ditampilkan.</small>
            </div>
            <button type="submit" class="btn btn-admin-primary btn-sm">
                <i class="bi bi-save me-1"></i>Simpan Kata Pembuka
            </button>
        </form>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0" style="font-size:.875rem;">Kelola data pejabat dan struktur organisasi program studi.</p>
    </div>
    <a href="{{ route('admin.pejabat.create') }}" class="btn btn-admin-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Pejabat
    </a>
</div>

<div class="admin-card card">
    <div class="card-body p-0">
        <table class="table admin-table mb-0">
            <thead>
                <tr>
                    <th style="width:50px">Urutan</th>
                    <th style="width:60px">Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>NIDN</th>
                    <th>Kontak</th>
                    <th style="width:80px">Status</th>
                    <th style="width:120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pejabat as $p)
                <tr>
                    <td class="text-center">
                        <span class="badge bg-secondary rounded-pill">{{ $p->urutan }}</span>
                    </td>
                    <td>
                        @if($p->foto)
                            <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama }}"
                                style="width:44px;height:44px;object-fit:cover;border-radius:50%;border:2px solid #eee;">
                        @else
                            <div style="width:44px;height:44px;background:var(--red);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:.9rem;">
                                {{ strtoupper(substr($p->nama, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:600; color:#1a1a2e;">{{ $p->nama }}</div>
                    </td>
                    <td>
                        <span style="font-size:.85rem; color:#555;">{{ $p->jabatan }}</span>
                    </td>
                    <td>
                        <span style="font-size:.82rem; color:#888;">{{ $p->nidn ?: '-' }}</span>
                    </td>
                    <td>
                        @if($p->email)
                            <div style="font-size:.8rem; color:#555;"><i class="bi bi-envelope me-1"></i>{{ $p->email }}</div>
                        @endif
                        @if($p->telepon)
                            <div style="font-size:.8rem; color:#888;"><i class="bi bi-telephone me-1"></i>{{ $p->telepon }}</div>
                        @endif
                        @if(!$p->email && !$p->telepon) <span class="text-muted">-</span> @endif
                    </td>
                    <td>
                        @if($p->is_active)
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Aktif</span>
                        @else
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.pejabat.edit', $p) }}" class="btn btn-sm btn-outline-primary rounded-2" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.pejabat.destroy', $p) }}" method="POST"
                                  onsubmit="return confirm('Hapus pejabat ini?')">
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
                    <td colspan="8" class="text-center text-muted py-5">
                        <i class="bi bi-people display-5 d-block mb-2 opacity-25"></i>
                        Belum ada data pejabat. <a href="{{ route('admin.pejabat.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
