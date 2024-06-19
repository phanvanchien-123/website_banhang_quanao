@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>Mã Giảm Giá</h2>
        <a href="{{ route('admin.coupon.create') }}">Thêm mới</a>
    </div>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>

                    <th scope="col">giảm giá_giá trị</th>

                    <th scope="col">số tiền giảm giá </th>
                    <th scope="col">giảm giá_loại</th>

                    <th scope="col">giá trị đơn hàng tối thiểu</th>
                    <th scope="col">Số lượng người giảm giá</th>
                    <th scope="col">Số người đã sử dụng</th>

                    <th scope="col">hết hạn_at</th>
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
                            <a href="{{ route('admin.coupon.edit', $item->id) }}"><i class="bi bi-pencil-square"></i></a> |
                            <a href="{{ route('admin.coupon.delete', $item->id) }}"><i class="bi bi-trash2-fill"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        {{$coupons->withQueryString()->links('Client.pagination.default')}}

        </table>
    </div>
@endsection
