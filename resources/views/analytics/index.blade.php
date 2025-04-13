@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Analytics Dashboard</h2>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('analytics.create') }}" class="btn btn-primary">+ Add New Analytics Data</a>
    </div>

    <div class="card mt-5">
        <div class="card-body">
            <h4 class="card-title">Traffic Overview (Visits per Day)</h4>
            <div class="row">
                <div class="col-12 mb-5">
                    <canvas id="lineChart" height="100"></canvas>
                </div>
                <div class="col-md-4 mb-4">
                    <canvas id="pieChart1"></canvas>
                </div>
                <div class="col-md-4 mb-4">
                    <canvas id="pieChart2"></canvas>
                </div>
                <div class="col-md-4 mb-4">
                    <canvas id="pieChart3"></canvas>
                </div>
            </div>

        </div>
    </div>

    <!-- Add date adapter for Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script> <!-- Add this line -->

    <script>
    const chartData = {
        !!$chartData!!
    }; // Ensure JSON is directly injected

    function getRandomColor() {
        return 'hsl(' + Math.floor(Math.random() * 360) + ', 70%, 50%)';
    }

    const ctx = document.getElementById('analyticsChart').getContext('2d');

    const analyticsChart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: chartData.map(item => ({
                label: item.label,
                data: item.data,
                borderWidth: 2,
                fill: false,
                borderColor: getRandomColor(),
                tension: 0.3
            }))
        },
        options: {
            parsing: false,
            responsive: true,
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'day'
                    },
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Visits'
                    }
                }
            }
        }
    });
    </script>


    <div class="d-flex justify-content-center">
        {{ $analytics->links() }}
    </div>
</div>
@endsection