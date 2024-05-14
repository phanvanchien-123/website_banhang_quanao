@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Role</h2>
        <a href="{{ route('admin.role.create') }}">Thêm mới</a>
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
                    <a href="{{ route('admin.role.edit',$item->id) }}">edit</a> |
                    <a href="{{ route('admin.role.delete',$item->id) }}">delete</a>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
        </table>
    </div>

@endsection