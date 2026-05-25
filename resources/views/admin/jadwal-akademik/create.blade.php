@extends('layouts.admin')
@section('title', 'Tambah Jadwal Akademik')
@section('page-title', 'Tambah Jadwal Akademik')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="admin-card card">
            <div class="card-header"><i class="bi bi-calendar-plus me-2"></i>Jadwal Akademik Baru</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.jadwal-akademik.store') }}" method="POST">
                    @csrf
                    @include('admin.jadwal-akademik._form')
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                        <a href="{{ route('admin.jadwal-akademik.index') }}" class="btn btn-outline-secondary rounded-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
