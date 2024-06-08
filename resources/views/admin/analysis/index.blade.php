@extends('admin.layout.main')
@section('content')
    <h2>Doanh thu & Lợi nhuận</h2>
    <div class="p-4 ">
        <form action="{{ route('admin.analytics.index') }}" method="GET">
            <label for="start_date">From:</label>
            <input type="date" id="start_date" name="start_date">
            <label for="end_date">To:</label>
            <input type="date" id="end_date" name="end_date">

            <button type="submit" class="btn btn-outline-primary ms-4">Generate Report</button>
            <a href="{{ route('admin.analytics.index') }}" class="btn btn-outline-primary">Show All</a>

        </form>
    </div>
    <div class="container">

        <canvas id="salesProfitChart" width="400" height="200"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesProfitChart').getContext('2d');

            const data = @json($results);

            const labels = data.map(item => item.date);
            const sales = data.map(item => item.sales);
            const profit = data.map(item => item.profit);

            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Sales',
                            data: sales,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Profit',
                            data: profit,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
