@extends('layouts.admin')
@section('title', 'Tambah Item Menu')
@section('page-title', 'Tambah Item Menu')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header"><i class="bi bi-plus-circle me-2"></i>Item Menu Baru</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.menu.store') }}" method="POST">
                    @csrf
                    @include('admin.menu._form')
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                        <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary rounded-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
