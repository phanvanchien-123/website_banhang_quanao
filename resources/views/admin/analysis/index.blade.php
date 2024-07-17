@extends('admin.layout.main')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <h2 class="pb-4">Thống kê</h2>
    <div class="p-4 d-flex">
        <form action="{{ route('admin.analytics.index') }}" method="GET" onsubmit="return validateForm()">
            <label for="start_date">From:</label>
            <input type="date" id="start_date" name="start_date" value="{{ Request::get('start_date') }}">
            <label for="end_date">To:</label>
            <input type="date" id="end_date" name="end_date" value="{{ Request::get('end_date') }}">

            <button type="submit" class="btn btn-outline-primary ms-4">Generate Report</button>
        </form>
        <a href="{{ route('admin.analytics.index') }}" class="btn btn-outline-primary ms-2">Show All</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="d-flex">
                <h4>Doanh thu</h4>
                <a class="ps-4 h6 export-excel text-success" href="#" data-chart="salesProfitChart"><i
                        class="bi bi-folder-symlink"></i>export</a>
            </div>
            <div class="col-12 rounded shadow">
                <canvas id="salesProfitChart" height="500px"></canvas>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-6">
                <div class="d-flex">
                    <h4>Tổng hợp</h4>
                    <a class="ps-4 h6 export-excel text-success" href="#" data-chart="summaryChart"><i
                            class="bi bi-folder-symlink "></i>export</a>
                </div>
                <div class="rounded shadow">
                    <canvas id="summaryChart" height="350px"></canvas>
                </div>
            </div>
            <div class="col-6 ">
                <div class="d-flex">
                    <h4>Đơn hàng</h4>
                    <a class="ps-4 h6 export-excel text-success" href="#" data-chart="orderStatusChart"><i
                            class="bi bi-folder-symlink "></i>export</a>
                </div>
                <div class="rounded shadow">
                    <canvas id="orderStatusChart" height="350px"></canvas>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-6">
                <div class="rounded shadow p-4">
                    <h3>Người dùng đặt hàng nhiều nhất</h3>
                    <ul>
                        @foreach ($topCustomers as $customer)
                            <li>
                                <div class="d-flex mt-4">
                                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : Auth::user()->defaultAvatar() }}"
                                        alt="profile" height="75px" width="75px" class="border">
                                    <div class="ps-4">
                                        <h5>{{ $customer->name }} ({{ $customer->email }})</h5>
                                        <p>Tổng số đơn hàng: {{ $customer->total_orders }}</p>
                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-6">
                <div class="rounded shadow p-4">
                    <h3>Sản phẩm bán chạy nhất</h3>
                    <ul>
                        @foreach ($topProducts as $product)
                            <li>
                                <div class="d-flex mt-4">
                                    <img src="{{ asset('storage/' . $product->avatar) }}" alt="" height="60px"
                                        width="60px" class="border">
                                    <div class="ps-4">
                                        <h5>{{ $product->name }} (id: {{ $product->id }})</h5>
                                        <p>Tổng số lượng bán ra: {{ $product->total_quantity_sold }}</p>
                                    </div>
                                </div>


                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy các context của các canvas
            const salesProfitCtx = document.getElementById('salesProfitChart').getContext('2d');
            const summaryCtx = document.getElementById('summaryChart').getContext('2d');
            const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');

            // Data Doanh thu & Lợi nhuận
            const salesProfitData = @json($salesAndProfit);
            const salesProfitLabels = salesProfitData.map(item => item.date);
            const sales = salesProfitData.map(item => item.sales);
            const profit = salesProfitData.map(item => item.profit);

            // Data số lượng order, product, blog
            const summaryData = {
                totalProducts: {{ $totalProducts }},
                totalPosts: {{ $totalPosts }},
                totalOrders: {{ $totalOrders }}
            };

            // Data trạng thái đơn hàng
            const orderStatusDataRaw = @json($orderStatusData);
            const orderStatusData = {
                labels: Object.keys(orderStatusDataRaw),
                datasets: [{
                    label: 'Số lượng đơn hàng',
                    data: Object.values(orderStatusDataRaw),
                    backgroundColor: [
                        'rgba(0, 0, 0, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(0, 0, 0, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            };

            // Tạo biểu đồ Doanh thu & Lợi nhuận
            function createSalesProfitChart() {
                new Chart(salesProfitCtx, {
                    type: 'bar',
                    data: {
                        labels: salesProfitLabels,
                        datasets: [{
                            label: 'Sales',
                            data: sales,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }, {
                            label: 'Profit',
                            data: profit,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            title: {
                                display: true,
                                text: 'Sales & Profit Report'
                            }
                        }
                    }
                });
            }

            // Tạo biểu đồ Tổng số sản phẩm, bài viết, đơn hàng
            function createSummaryChart() {
                new Chart(summaryCtx, {
                    type: 'pie',
                    data: {
                        labels: ['Total Products', 'Total Blogs', 'Total Orders'],
                        datasets: [{
                            data: [summaryData.totalProducts, summaryData.totalPosts, summaryData
                                .totalOrders
                            ],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            title: {
                                display: true,
                                text: 'Summary Report'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw;
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Tạo biểu đồ Trạng thái đơn hàng
            function createOrderStatusChart() {
                new Chart(orderStatusCtx, {
                    type: 'bar',
                    data: orderStatusData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Order Status Statistics'
                            },
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }

            // Gọi các hàm để tạo biểu đồ
            createSalesProfitChart();
            createSummaryChart();
            createOrderStatusChart();


            // Hàm xuất dữ liệu ra Excel
            function exportChartToExcel(chartId) {
                const chart = Chart.getChart(chartId);
                if (!chart) {
                    alert('Biểu đồ không tồn tại');
                    return;
                }

                const chartData = chart.data;
                const labels = chartData.labels;
                const datasets = chartData.datasets;

                // Tạo một mảng 2D để lưu dữ liệu
                let data = [
                    ['Label']
                ];
                datasets.forEach(dataset => {
                    data[0].push(dataset.label);
                });

                for (let i = 0; i < labels.length; i++) {
                    const row = [labels[i]];
                    datasets.forEach(dataset => {
                        row.push(dataset.data[i]);
                    });
                    data.push(row);
                }

                // Chuyển mảng 2D thành một worksheet của Excel
                const worksheet = XLSX.utils.aoa_to_sheet(data);

                // Tạo workbook và thêm worksheet vào đó
                const workbook = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');

                // Xuất workbook thành file Excel
                XLSX.writeFile(workbook, `${chartId}_data.xlsx`);
            }

            // Gắn sự kiện click cho các nút export
            document.querySelectorAll('.export-excel').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const chartId = this.getAttribute('data-chart');
                    exportChartToExcel(chartId);
                });
            });
        });
    </script>


    <script>
        function validateForm() {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;

            if (!startDate || !endDate) {
                // Sử dụng Toastr để hiển thị thông báo
                toastr.error('Vui lòng nhập đủ thông tin.', 'Error');
                return false; // Ngăn chặn việc gửi biểu mẫu nếu dữ liệu thiếu
            }

            return true; // Cho phép gửi biểu mẫu nếu dữ liệu đầy đủ
        }
    </script>
@endsection
