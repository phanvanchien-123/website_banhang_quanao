@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Bài viết</h2>
        <a href="{{ route('admin.blog.create') }}" class="text-decoration-none"><i class="bi bi-plus-square"></i> Thêm mới </a>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Avata</th>
                    <th scope="col">tiêu đề</th>
                    <th scope="col">Ngày tạo</th>
                    <th scope="col">thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs ?? [] as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>
                            <img src="{{ asset('storage/' . $item->image) }}" alt="" width="60px" height="60px">
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.blog.edit', $item->id) }}"><i class="bi bi-pencil-square"></i></a> |
                            <a href="{{ route('admin.blog.delete', $item->id) }}"><i class="bi bi-trash2-fill"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$blogs->withQueryString()->links('Client.pagination.default')}}
    </div>
@endsection
