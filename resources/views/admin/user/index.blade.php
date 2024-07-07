@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center pb-4">
        <h2>Tài khoản</h2>
    </div>
    <div class="input-group flex-nowrap my-3">
        <div class="d-flex w-100">
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary rounded-0"><i
                    class="bi bi-arrow-clockwise "></i></a>
            <form action="" class="ps-2 d-flex">
                <input type="text" class="form-control rounded-0" placeholder="Search" name="search"
                    value="{{ Request::get('search') }}">
                <button type="submit" class="btn btn-primary ms-2 rounded-0"> tìm kiếm</button>
            </form>
            <a href="{{ route('admin.user.create') }}" class="text-decoration-none ms-auto text-success"><i
                    class="bi bi-plus-square h4"></i> Thêm
                mới</a>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Avata</th>
                    <th scope="col">Tên tài khoản <a
                            href="?sort=name&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">Email <a
                            href="?sort=email&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users ?? [] as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td><img src="{{ asset('storage/' . $item->avatar) }}" alt="" width="60px" height="60px">
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a href="{{ route('admin.user.edit', $item->id) }}"><i
                                    class="bi bi-pencil-square text-warning"></i></a> |
                            <a href="#"
                                onclick="confirmDelete(event, '{{ route('admin.user.delete', $item->id) }}')">
                                <i class="bi bi-trash2-fill text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $users->withQueryString()->links('Client.pagination.default') }}

    </div>
@endsection
