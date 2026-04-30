@extends('layouts.admin')
@section('title', 'Tambah Pejabat')
@section('page-title', 'Tambah Pejabat')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="admin-card card">
            <div class="card-header"><i class="bi bi-person-plus me-2"></i>Data Pejabat Baru</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.pejabat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.pejabat._form')
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                        <a href="{{ route('admin.pejabat.index') }}" class="btn btn-outline-secondary rounded-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
