@extends('layouts.admin')
@section('title', 'Edit Profil')
@section('page-title', 'Edit Profil')
@section('content')

@php $activeTab = session('tab', 'profil'); @endphp

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3 mb-4">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-7">

        {{-- Avatar card --}}
        <div class="admin-card card mb-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-4">
                    {{-- Avatar --}}
                    <div style="position:relative; flex-shrink:0;">
                        @if($user->foto)
                        <img src="{{ $user->foto_url }}" alt="{{ $user->name }}"
                             style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid #f5c0cc;">
                        @else
                        <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:900;color:white;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        @endif
                        <label for="quickFoto" title="Ganti foto"
                               style="position:absolute;bottom:0;right:0;width:26px;height:26px;border-radius:50%;background:#C0304A;display:flex;align-items:center;justify-content:center;cursor:pointer;border:2px solid white;">
                            <i class="bi bi-camera-fill" style="font-size:.7rem;color:white;"></i>
                        </label>
                    </div>
                    <div class="flex-fill">
                        <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
                        <p class="text-muted mb-1" style="font-size:.85rem;">{{ $user->email }}</p>
                        <span class="badge" style="background:#fff0f3;color:#C0304A;font-size:.72rem;">
                            {{ $user->role?->nama ?? 'Administrator' }}
                        </span>
                    </div>
                    @if($user->foto)
                    <form action="{{ route('admin.profile.foto.destroy') }}" method="POST"
                          onsubmit="return confirm('Hapus foto profil?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger rounded-2" title="Hapus foto">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    @endif
                </div>

                {{-- Quick upload form (hidden, triggered by camera icon) --}}
                <form action="{{ route('admin.profile.foto') }}" method="POST" enctype="multipart/form-data" id="quickFotoForm">
                    @csrf
                    <input type="file" id="quickFoto" name="foto" class="d-none"
                           accept="image/jpg,image/jpeg,image/png,image/webp"
                           onchange="this.form.submit()">
                </form>
                @error('foto')<div class="text-danger mt-2" style="font-size:.82rem;"><i class="bi bi-x-circle me-1"></i>{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- Tabs --}}
        <ul class="nav nav-pills mb-4 gap-2" id="profileTab">
            <li class="nav-item">
                <button class="nav-link px-4 {{ $activeTab === 'profil' ? 'active' : '' }}"
                        onclick="showTab('profil')" type="button">
                    <i class="bi bi-person me-2"></i>Informasi Profil
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link px-4 {{ $activeTab === 'password' ? 'active' : '' }}"
                        onclick="showTab('password')" type="button">
                    <i class="bi bi-shield-lock me-2"></i>Ubah Password
                </button>
            </li>
        </ul>

        {{-- Tab: Profil --}}
        <div id="tab-profil" class="admin-card card {{ $activeTab !== 'profil' ? 'd-none' : '' }}">
            <div class="card-header fw-bold">Informasi Profil</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        {{-- Tab: Password --}}
        <div id="tab-password" class="admin-card card {{ $activeTab !== 'password' ? 'd-none' : '' }}">
            <div class="card-header fw-bold">Ubah Password</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Password Saat Ini <span class="text-danger">*</span></label>
                        <input type="password" name="current_password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               placeholder="••••••••">
                        @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
                    </div>
                    <button type="submit" class="btn btn-admin-primary">
                        <i class="bi bi-shield-check me-2"></i>Ubah Password
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<style>
.nav-pills .nav-link { color: #555; border-radius: 50px; }
.nav-pills .nav-link.active { background: linear-gradient(135deg,#C0304A,#8B1A2E); }
</style>
<script>
function showTab(tab) {
    document.getElementById('tab-profil').classList.toggle('d-none', tab !== 'profil');
    document.getElementById('tab-password').classList.toggle('d-none', tab !== 'password');
    document.querySelectorAll('#profileTab .nav-link').forEach((el, i) => {
        el.classList.toggle('active', (i === 0 && tab === 'profil') || (i === 1 && tab === 'password'));
    });
}
</script>
@endsection
