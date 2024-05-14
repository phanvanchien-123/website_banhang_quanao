@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Danh mục</h2>
        <a href="{{ route('admin.category.create') }}">Thêm mới</a>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Avata</th>
                  <th scope="col">Tên danh mục</th>
                  <th scope="col">Ngày tạo</th>
                  <th scope="col">thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($categories ?? [] as $item)
                    <tr>
                  <th scope="row">{{ $item->id }}</th>
                  <td><img src="{{ $item->avatar }}" alt="" width="60px" height="60px"></td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->created_at }}</td>
                  <td>
                    <a href="{{ route('admin.category.edit',$item->id) }}">edit</a> |
                    <a href="{{ route('admin.category.delete',$item->id) }}">delete</a>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
        </table>
    </div>

@endsection