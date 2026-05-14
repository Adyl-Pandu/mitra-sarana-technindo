@extends('layouts.admin')
@section('title', 'Tambah Kategori')

@section('content')
<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl">
    @csrf
    @include('admin.categories._form', ['category' => null])
</form>
@endsection
