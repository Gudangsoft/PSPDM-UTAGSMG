@extends('layouts.admin')
@section('title', 'Edit Item Menu')
@section('page-title', 'Edit Item Menu')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header"><i class="bi bi-pencil me-2"></i>Edit — {{ $menu->label }}</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.menu.update', $menu) }}" method="POST">
                    @csrf @method('PUT')
                    @include('admin.menu._form', ['model' => $menu])
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-1"></i>Perbarui
                        </button>
                        <a href="{{ route('admin.menu.index') }}" class="btn btn-outline-secondary rounded-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
