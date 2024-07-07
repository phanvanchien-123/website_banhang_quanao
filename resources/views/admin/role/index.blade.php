@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center pb-4">
        <h2>Role</h2>
    </div>
    <div class="input-group flex-nowrap my-3">
        <div class="d-flex w-100">
            <a href="{{ route('admin.role.index') }}" class="btn btn-secondary rounded-0"><i
                    class="bi bi-arrow-clockwise "></i></a>
            <form action="" class="ps-2 d-flex">
                <input type="text" class="form-control rounded-0" placeholder="Search" name="search"
                    value="{{ Request::get('search') }}">
                <button type="submit" class="btn btn-primary ms-2 rounded-0"> tìm kiếm</button>
            </form>
            <a href="{{ route('admin.role.create') }}" class="text-decoration-none ms-auto text-success"><i
                    class="bi bi-plus-square h4"></i> Thêm
                mới</a>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên role <a
                            href="?sort=name&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>
                    {{-- <th scope="col">Slug</th> --}}
                    <th scope="col">Ngày tạo <a
                            href="?sort=created_at&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>
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
                            <a href="{{ route('admin.role.edit', $item->id) }}"><i
                                    class="bi bi-pencil-square text-warning"></i></a> |
                            <a href="#" onclick="confirmDelete(event, '{{ route('admin.role.delete', $item->id) }}')">
                                <i class="bi bi-trash2-fill text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $roles->withQueryString()->links('Client.pagination.default') }}

    </div>
@endsection
