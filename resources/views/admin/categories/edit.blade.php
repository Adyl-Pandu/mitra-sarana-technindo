@extends('layouts.admin')
@section('title', 'Edit Kategori')

@section('content')
<form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="max-w-2xl">
    @csrf @method('PUT')
    @include('admin.categories._form', ['category' => $category])
</form>
@endsection
