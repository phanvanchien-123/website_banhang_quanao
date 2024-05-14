@extends('Backend.layout.app_backend')
@section('content')
@php
  $action_url = route('admin.category.update',$category->id);
@endphp
    <div class="d-flex justify-content-between align-items-center">
        <h2>Cập nhật danh mục</h2>
        <a href="{{ route('admin.category.index') }}">Trở về</a>
    </div>
    @include('Backend.category.form')

    {{-- <form method="POST" action="{{ route('admin.category.update',$category->id) }}" autocomplete="off">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="quần áo, xe,..." name="name" value="{{ $category->name }}">
            @error('name')
                <small class="text-danger ms-4">{{ $errors->first('name')  }}</small>
            @enderror
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control" id="exampleFormControlInput2" placeholder="" name="avatar" value="">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">mô tả</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" value="">{{ $category->description }}</textarea>
          </div>
          <button type="submit" class="btn btn-outline-primary">Lưu dữ liệu</button>
    </form> --}}


@endsection