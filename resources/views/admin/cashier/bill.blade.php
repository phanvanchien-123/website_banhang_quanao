<!-- resources/views/invoice.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .bill,
            .bill * {
                visibility: visible;
            }

            .bill {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container bill">
        <div class="row pt-4 d-flex">
            <div class="col-7 avatar">
                <img src="{{ asset('storage/' . $logo->path) }}"
                    alt="" class="img-fluid">
            </div>
            <div class="col-5 shopInfor">
                <p class="mb-1">Phone: +1 0000000000</p>
                <p class="mb-1">Address: NIT, Faridabad, Haryana, India</p>
                <p class="mb-0">Email: Contact@Surfsidemedia.In</p>
            </div>
        </div>
        <div class="text-center pt-4">
            <h3>Hóa đơn bán hàng</h3>
        </div>
        <div class="row pt-4">
            <div class="col">
                <div class="form-floating mb-3">
                    {{-- <input type="text" class="form-control" id="customerName"
                        value="{{ $invoiceData['customerName'] }}" readonly>
                    <label for="customerName">Khách hàng</label> --}}
                    Khách hàng: {{ $invoiceData['customerName'] }}
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    {{-- <input type="number" class="form-control" id="customerPhone"
                        value="{{ $invoiceData['customerPhone'] }}" readonly>
                    <label for="customerPhone">Số điện thoại</label> --}}
                    Số điện thoại: {{ $invoiceData['customerPhone'] }}
                </div>
            </div>
        </div>
        <div class="form-floating mb-3">
            {{-- <input type="text" class="form-control" id="customerAddress"
                value="{{ $invoiceData['customerAddress'] }}" readonly>
            <label for="customerAddress">Địa chỉ</label> --}}
            Địa chỉ: {{ $invoiceData['customerAddress'] }}
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoiceData['billItems'] ?? '' as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item['productName'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['unitPrice'] }}</td>
                            <td>{{ $item['totalPrice'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{-- @if (isset($invoiceData['billItems']) && is_array($invoiceData['billItems']) && count($invoiceData['billItems']) > 0) --}}
                <h3 class="mb-0">Tổng tiền: <span>{{ $total ?? '' }}đ</span></h3>
            {{-- @endif --}}

        </div>
        <p class="text-end" id="current-date"></p>
        <div class="row mt-4">
            {{-- <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="receiver" value="{{ $invoiceData['receiver'] }}"
                        readonly>
                    <label for="receiver">Người nhận</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="deliverer" value="{{ $invoiceData['deliverer'] }}"
                        readonly>
                    <label for="deliverer">Người giao</label>
                </div>
            </div> --}}
            <div class="col">
                <div class="form-floating mb-3">
                    {{-- <input type="text" class="form-control" id="creator" value="{{ $invoiceData['creator'] }}"
                        readonly>
                    <label for="creator">Người lập</label> --}}
                    Người tạo: {{ $invoiceData['creator'] }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatCurrentDate() {
            const today = new Date();
            const day = today.getDate();
            const monthNames = ["tháng 1", "tháng 2", "tháng 3", "tháng 4", "tháng 5", "tháng 6", "tháng 7", "tháng 8",
                "tháng 9", "tháng 10", "tháng 11", "tháng 12"
            ];
            const month = monthNames[today.getMonth()];
            const year = today.getFullYear();

            return `${day} / ${month} / ${year}`;
        }

        document.getElementById('current-date').textContent = formatCurrentDate();
    </script>

</body>

</html>
