@extends('layouts.admin')
@section('title', 'Edit Produk')

@section('content')
<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.products._form', ['product' => $product])
</form>
@endsection
