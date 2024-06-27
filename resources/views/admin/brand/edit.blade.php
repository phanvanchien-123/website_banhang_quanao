@extends('admin.layout.main')
@section('content')
@php
  $action_url = route('admin.brand.update',$brand->id);
@endphp
    <div class="d-flex justify-content-between align-items-center">
        <h2>Cập nhật thương hiệu</h2>
        <a href="{{ route('admin.brand.index') }}" class="text-decoration-none"><i class="bi bi-box-arrow-left"></i> Trở về</a>
    </div>
    @include('admin.brand.form')



@endsection