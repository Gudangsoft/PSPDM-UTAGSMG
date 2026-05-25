@extends('layouts.admin')
@section('title', 'Edit Jadwal Akademik')
@section('page-title', 'Edit Jadwal Akademik')
@section('content')

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="admin-card card">
            <div class="card-header"><i class="bi bi-pencil-square me-2"></i>Edit: {{ $jadwalAkademik->kegiatan }}</div>
            <div class="card-body p-4">
                <form action="{{ route('admin.jadwal-akademik.update', $jadwalAkademik) }}" method="POST">
                    @csrf @method('PUT')
                    @include('admin.jadwal-akademik._form', ['model' => $jadwalAkademik])
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-1"></i>Perbarui
                        </button>
                        <a href="{{ route('admin.jadwal-akademik.index') }}" class="btn btn-outline-secondary rounded-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
