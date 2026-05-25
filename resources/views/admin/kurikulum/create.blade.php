@extends('layouts.admin')
@section('title', 'Tambah Mata Kuliah')
@section('page-title', 'Tambah Mata Kuliah')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="admin-card card">
            <div class="card-header"><i class="bi bi-book-half me-2"></i>Data Mata Kuliah Baru</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.kurikulum.store') }}" method="POST">
                    @csrf
                    @include('admin.kurikulum._form')
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                        <a href="{{ route('admin.kurikulum.index') }}" class="btn btn-outline-secondary rounded-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
