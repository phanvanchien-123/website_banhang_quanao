@extends('Backend.layout.app_backend')
@section('content')
@php
  $action_url = route('admin.category.store');
@endphp
    <div class="d-flex justify-content-between align-items-center">
        <h2>Thêm mới danh mục</h2>
        <a href="{{ route('admin.category.index') }}">Trở về</a>
    </div>
    @include('Backend.category.form')
    {{-- <form method="POST" action="{{ route('admin.category.store') }}" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="quần áo, xe,..." name="name">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="exampleFormControlInput2" placeholder="" name="avatar">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">mô tả</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
          </div>
          <button type="submit" class="btn btn-outline-primary">Lưu dữ liệu</button>
    </form> --}}


@endsection