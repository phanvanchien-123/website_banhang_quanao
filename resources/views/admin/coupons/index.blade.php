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
                 @foreach ($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->discount_value }}</td>
                    <td>{{ $coupon->discount_type }}</td>
                    <td>{{ $coupon->minimum_order_value }}</td>
                    <td>{{ $coupon->usage_limit }}</td>
                    <td>{{ $coupon->used_count }}</td>
                    <td>{{ $coupon->expires_at }}</td>
                    <td>
                        <a href="{{ route('admin.coupon.edit', $coupon->id) }}">Edit</a>
                        <form action="{{ route('admin.coupon.delete', $coupon->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
