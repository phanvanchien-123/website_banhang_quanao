<div class="tab-pane fade table-dashboard dashboard wish-list-section" id="order">
    <div class="box-head mb-3">
        <h3>Đơn hàng đag chờ xác nhận </h3>
    </div>
    <div class="table-responsive">
        <table class="table cart-table">
            <thead>
                <tr class="table-head">
                    <th scope="col">Order Id</th>
                    <th scope="col">Ngày Đặt Đơn </th>
                    <th scope="col"> Hình thức thanh toán</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hủy Đơn</th>
                    <th scope="col">Tổng Tiền</th>

                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingorders as $order)
                    <tr>

                        <td>
                            <p class="mt-0">{{ $order->id }}</p>
                        </td>

                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $order->payment_type == '0' ? 'Trực tiếp' : 'Online' }}</td>
                        <td>
                            @if ($order->status == 1)
                                <p class="danger-button btn btn-sm">
                                    {{ \App\Untilities\Constant::$order_status[$order->status] }}</p>
                            @else
                                <p class="success-button btn btn-sm">
                                    {{ \App\Untilities\Constant::$order_status[$order->status] }}</p>
                            @endif

                        </td>

                        @if ($order->status == 1)
                            {{-- Giả sử trạng thái 1 là trạng thái cho phép hủy đơn hàng --}}
                            <td>
                                {{-- <form action="/my_account/dashboard/cancel_order/{{ $order->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hủy đơn hàng</button>
                        </form> --}}
                                <a role="button" class="btn-danger btn-sm"
                                    onclick="confirmDelete(event, '{{ route('order.cancel', $order->id) }}')">
                                    Hủy đơn hàng
                                </a>
                            </td>
                        @endif

                        <td>
                            <p class="theme-color fs-6">
                                {{ number_format($order->total, 3) }}VND
                            </p>
                        </td>
                        <td>
                            <a href="/my_account/dashboard/{{ $order->id }}">
                                <i class="far fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
