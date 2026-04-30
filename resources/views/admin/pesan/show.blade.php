@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('page-title', 'Detail Pesan')
@section('content')
<div class="mb-3">
    <a href="{{ route('admin.pesan.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-envelope-open me-2"></i>Pesan dari {{ $pesan->nama }}</span>
                <small class="text-muted">{{ $pesan->created_at->isoFormat('D MMMM Y, HH:mm') }}</small>
            </div>
            <div class="card-body p-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            <div style="font-size:.75rem; text-transform:uppercase; font-weight:700; color:#888; margin-bottom:4px;">Nama</div>
                            <div style="font-weight:600; color:#333;">{{ $pesan->nama }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            <div style="font-size:.75rem; text-transform:uppercase; font-weight:700; color:#888; margin-bottom:4px;">Email</div>
                            <a href="mailto:{{ $pesan->email }}" style="font-weight:600; color:var(--red); text-decoration:none;">{{ $pesan->email }}</a>
                        </div>
                    </div>
                    @if($pesan->telepon)
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            <div style="font-size:.75rem; text-transform:uppercase; font-weight:700; color:#888; margin-bottom:4px;">Telepon</div>
                            <div style="font-weight:600; color:#333;">{{ $pesan->telepon }}</div>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background:#f8f9fa;">
                            <div style="font-size:.75rem; text-transform:uppercase; font-weight:700; color:#888; margin-bottom:4px;">Subjek</div>
                            <div style="font-weight:600; color:#333;">{{ $pesan->subjek }}</div>
                        </div>
                    </div>
                </div>
                <div class="p-4 rounded-3" style="background:#fff5f5; border-left:4px solid var(--red);">
                    <div style="font-size:.75rem; text-transform:uppercase; font-weight:700; color:#888; margin-bottom:10px;">Pesan</div>
                    <p style="line-height:1.8; color:#444; white-space:pre-line; margin:0;">{{ $pesan->pesan }}</p>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <a href="mailto:{{ $pesan->email }}?subject=Re: {{ $pesan->subjek }}" class="btn btn-admin-primary">
                        <i class="bi bi-reply me-2"></i>Balas via Email
                    </a>
                    <form action="{{ route('admin.pesan.destroy', $pesan) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger rounded-2 py-2"><i class="bi bi-trash me-1"></i>Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
