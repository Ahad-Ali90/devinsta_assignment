<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Load Chart.js first -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Load Moment.js and Chartjs date adapter second -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>

    <!-- Optional Custom CSS -->
    <style>
    body {
        background-color: #f8f9fa;
    }

    .navbar-brand {
        font-weight: bold;
    }

    footer {
        background-color: #ffffff;
        padding: 1rem;
        border-top: 1px solid #dee2e6;
        text-align: center;
    }
    </style>
</head>

<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Analytics Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('analytics.index') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('analytics.create') }}">Add Data</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <small>&copy; {{ date('Y') }} abc.com | Centralized Analytics Viewer</small>
        </div>
    </footer>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Simulated data - replace with dynamic PHP data if needed
    const lineChartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Seed Total',
            data: [30, 45, 60, 75, 90, 100],
            backgroundColor: 'rgba(0, 123, 255, 0.3)',
            borderColor: 'rgba(0, 123, 255, 1)',
            fill: true,
            tension: 0.3
        }]
    };

    const pieData = {
        labels: ['Category 1', 'Category 2', 'Category 3', 'Category 4', 'Category 5'],
        datasets: [{
            data: [30, 15, 20, 10, 25],
            backgroundColor: [
                '#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8'
            ]
        }]
    };

    // Devices chart
    const devicesData = {
        labels: ['Android', 'iPhone', 'PC'],
        datasets: [{
            data: [20, 15, 10],
            backgroundColor: ['#20c997', '#6610f2', '#fd7e14']
        }]
    };

    // Render Charts
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: lineChartData,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(document.getElementById('pieChart1'), {
        type: 'pie',
        data: pieData
    });

    new Chart(document.getElementById('pieChart2'), {
        type: 'pie',
        data: pieData
    });

    new Chart(document.getElementById('pieChart3'), {
        type: 'pie',
        data: devicesData
    });
    </script>

</body>

</html>