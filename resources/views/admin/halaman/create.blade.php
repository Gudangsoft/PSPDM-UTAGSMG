@extends('layouts.admin')
@section('title', 'Buat Halaman')
@section('page-title', 'Buat Halaman Baru')
@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
@endsection
@section('content')
<form action="{{ route('admin.halaman.store') }}" method="POST">
    @csrf
    @include('admin.halaman._form')
</form>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
<script>
$('#konten').summernote({
    height: 380,
    placeholder: 'Tulis konten halaman di sini...',
    toolbar: [
        ['style', ['bold','italic','underline','clear']],
        ['font', ['strikethrough']],
        ['para', ['ul','ol','paragraph']],
        ['insert', ['link','picture','hr']],
        ['view', ['fullscreen','codeview']],
    ]
});
</script>
@endsection
