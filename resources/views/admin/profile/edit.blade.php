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

        {{-- Avatar info --}}
        <div class="admin-card card mb-4">
            <div class="card-body p-4 d-flex align-items-center gap-4">
                <div style="width:72px;height:72px;border-radius:50%;background:linear-gradient(135deg,#C0304A,#8B1A2E);display:flex;align-items:center;justify-content:center;font-size:1.8rem;font-weight:900;color:white;flex-shrink:0;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
                    <p class="text-muted mb-0" style="font-size:.85rem;">{{ $user->email }}</p>
                    <span class="badge mt-1" style="background:#fff0f3;color:#C0304A;font-size:.72rem;">Administrator</span>
                </div>
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
