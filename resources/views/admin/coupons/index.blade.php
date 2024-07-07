@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center pb-4">
        <h2>Mã Giảm Giá</h2>
    </div>
    <div class="input-group flex-nowrap my-3">
        <div class="d-flex w-100">
            <a href="{{ route('admin.coupon.index') }}" class="btn btn-secondary rounded-0"><i
                    class="bi bi-arrow-clockwise"></i></a>
            <form action="" class="ps-2 d-flex">
                <input type="text" class="form-control rounded-0" placeholder="Search" name="search"
                    value="{{ Request::get('search') }}">
                <button type="submit" class="btn btn-primary ms-2 rounded-0"> tìm kiếm</button>
            </form>
            <a href="{{ route('admin.coupon.create') }}" class="text-decoration-none ms-auto text-success"><i
                    class="bi bi-plus-square h4"></i> Thêm
                mới</a>
        </div>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>

                    <th scope="col">mã <a href="?sort=code&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>

                    <th scope="col">giá trị <a
                            href="?sort=discount_value&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">loại <a
                            href="?sort=discount_type&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>

                    <th scope="col">giá trị đơn hàng tối thiểu <a
                            href="?sort=minimum_order_value&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">Số lượng <a
                            href="?sort=usage_limit&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">Số lượng đã sử dụng <a
                            href="?sort=used_count&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>

                    <th scope="col">hết hạn <a
                            href="?sort=expires_at&order={{ request('order') === 'asc' ? 'desc' : 'asc' }}"><i
                                class="bi bi-arrow-down-up"></i></a></th>
                    <th scope="col">Actions</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $item)
                    <tr>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->discount_value }}</td>
                        <td>{{ $item->discount_type }}</td>
                        <td>{{ $item->minimum_order_value }}</td>
                        <td>{{ $item->usage_limit }}</td>
                        <td>{{ $item->used_count }}</td>
                        <td>{{ $item->expires_at }}</td>
                        <td>
                            <a href="{{ route('admin.coupon.edit', $item->id) }}"><i
                                    class="bi bi-pencil-square text-warning"></i></a> |
                            <a href="#"
                                onclick="confirmDelete(event, '{{ route('admin.coupon.delete', $item->id) }}')">
                                <i class="bi bi-trash2-fill text-danger"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ $coupons->withQueryString()->links('Client.pagination.default') }}

        </table>
    </div>
@endsection
