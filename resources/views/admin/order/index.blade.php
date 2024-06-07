@extends('admin.layout.main')
@section('content')
    <h2>Order List</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Ngày tạo</th>
                <th scope="col">Hình thức thanh toán</th>
                <th scope="col">Tổng tiền</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders ?? [] as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->first_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $item->payment_type == '0' ? 'Trực tiếp' : 'Online' }}</td>
                    <td>{{ $item->total_sum }}</td>
                    <td>
                        <select class="form-select form-select-lg mb-3 w-75" aria-label="Large select example" data-comment-id="{{ $item->id }}">
                            <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Hủy bỏ</option>
                            <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Chờ Xác nhận đơn hàng</option>
                            <option value="2" {{ $item->status == 2 ? 'selected' : '' }}>Chưa được xác nhận</option>
                            <option value="3" {{ $item->status == 3 ? 'selected' : '' }}>Xác nhận</option>
                            <option value="5" {{ $item->status == 5 ? 'selected' : '' }}>Xử lý</option>
                            <option value="6" {{ $item->status == 6 ? 'selected' : '' }}>Đang chuyển hàng</option>
                            <option value="7" {{ $item->status == 7 ? 'selected' : '' }}>Hoàn thành</option>
                        </select>
                    </td>
                    <td>
                        <a href="{{ route('admin.order.show', $item->id) }}"><i class="bi bi-eye-fill"></i></a> |
                        <a href="{{ route('admin.order.delete', $item->id) }}"><i class="bi bi-trash2-fill"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectElements = document.querySelectorAll('.form-select');

            selectElements.forEach(select => {
                select.addEventListener('change', function() {
                    const commentId = this.dataset.commentId; // Lấy comment ID từ data attribute
                    const status = this.value;

                    fetch(`order/update/${commentId}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token
                            },
                            body: JSON.stringify({
                                status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Status updated successfully');
                            } else {
                                console.error('Failed to update status');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script>
@endsection
