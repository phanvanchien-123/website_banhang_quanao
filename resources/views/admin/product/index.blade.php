@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center pb-4">
        <div class="d-flex align-items-center">
            <h2>Sản phẩm</h2> &nbsp&nbsp&nbsp&nbsp|<a href="{{ route('admin.product.stock') }}">Kho hàng</a>
        </div>
    </div>
    <div class="input-group flex-nowrap my-3">
        <div class="d-flex w-100">
            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary rounded-0"><i class="bi bi-arrow-clockwise "></i></a>
            <form action="" class="ps-2 d-flex">
                <input type="text" class="form-control rounded-0" placeholder="Search" name="search"
                    value="{{ Request::get('search') }}">
                <button type="submit" class="btn btn-primary ms-2 rounded-0"> tìm kiếm</button>
            </form>
            <a href="{{ route('admin.product.create') }}" class="text-decoration-none ms-auto text-success"><i class="bi bi-plus-square h4"></i> Thêm
                mới</a>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Avata</th>
                    <th scope="col">Tên sản phẩm <a href="?sort=name&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                        class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">Danh mục <a href="?sort=product_category_id&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                        class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">Giá <a href="?sort=price&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                        class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">Ngày tạo <a href="?sort=created_at&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                        class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products ?? [] as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td><img src="{{ asset('storage/' . $item->avatar) }}" alt="" width="60px" height="60px">
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->productCategory->name ?? '' }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.product.edit', $item->id) }}"><i class="bi bi-pencil-square text-warning"></i></a>
                            |
                            <a href="#"
                                onclick="confirmDelete(event, '{{ route('admin.product.delete', $item->id) }}')">
                                <i class="bi bi-trash2-fill text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        {{ $products->withQueryString()->links('Client.pagination.default') }}
    </div>
@endsection
