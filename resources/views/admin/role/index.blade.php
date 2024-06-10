@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Role</h2>
        <a href="{{ route('admin.role.create') }}" class="text-decoration-none"><i class="bi bi-plus-square"></i> Thêm mới</a>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tên role</th>
                  {{-- <th scope="col">Slug</th> --}}
                  <th scope="col">Ngày tạo</th>
                  <th scope="col">thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($roles ?? [] as $item)
                    <tr>
                  <th scope="row">{{ $item->id }}</th>
                  {{-- <td><img src="{{ $item->avatar }}" alt="" width="60px" height="60px"></td> --}}
                  <td>{{ $item->name }}</td>
                  {{-- <td>{{ $item->slug }}</td> --}}
                  <td>{{ $item->created_at }}</td>
                  <td>
                    <a href="{{ route('admin.role.edit',$item->id) }}"><i class="bi bi-pencil-square"></i></a> |
                    <a href="{{ route('admin.role.delete',$item->id) }}"><i class="bi bi-trash2-fill"></i></a>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
        </table>
    </div>

@endsection