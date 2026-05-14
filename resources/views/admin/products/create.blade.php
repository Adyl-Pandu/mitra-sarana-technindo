@extends('layouts.admin')
@section('title', 'Tambah Produk')

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.products._form', ['product' => null])
</form>
@endsection
