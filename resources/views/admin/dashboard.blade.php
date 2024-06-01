@extends('layouts.admin')

@section('content')
<style>
    .stat-card {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        margin-bottom: 1rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .stat-card h3 {
        margin: 0;
        font-size: 2rem;
        color: #333;
    }
    .stat-card p {
        margin: 0;
        font-size: 1rem;
        color: #666;
    }
    .card {
        transition: 0.3s;
    }
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .card-body {
        padding: 2rem;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding: 1rem;
    }
    .container {
        padding: 2rem;
    }
    h1 {
        text-align: center;
        margin-bottom: 2rem;
        font-size: 2.5rem;
        color: #333;
    }
    .chart-container {
        margin-top: 2rem;
        position: relative;
    }
    .filter-buttons {
        position: absolute;
        top: 0;
        right: 0;
        display: flex;
        gap: 5px;
    }
    .filter-buttons form,
    .report-button form {
        display: inline;
    }
    .filter-buttons button,
    .report-button button {
        margin: 0 5px;
        padding: 10px 20px;
        cursor: pointer;
    }
    .report-button {
        position: absolute;
        top: 0;
        left: 0;
    }
</style>

<div class="container">
    <h1>Dashboard</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <h3>{{ $userCount }}</h3>
                    <p>Registered Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card stat-card">
                <div class="card-body">
                    <h3>{{ $pendingUserCount }}</h3>
                    <p>Pending Students</p>
                </div>
            </div>
        </div>
    </div>

    <div class="chart-container">
        <div class="report-button">
            <form action="{{ route('admin.generateReport') }}" method="GET">
                <input type="hidden" name="filter" value="{{ $filter }}">
                <button type="submit">Generate PDF Report</button>
            </form>
        </div>
        <div class="filter-buttons">
            <form action="{{ route('admin.dashboard') }}" method="GET">
                <input type="hidden" name="filter" value="day">
                <button type="submit" {{ $filter == 'day' ? 'style=background-color:#007bff;color:white;' : '' }}>Day</button>
            </form>
            <form action="{{ route('admin.dashboard') }}" method="GET">
                <input type="hidden" name="filter" value="month">
                <button type="submit" {{ $filter == 'month' ? 'style=background-color:#007bff;color:white;' : '' }}>Month</button>
            </form>
            <form action="{{ route('admin.dashboard') }}" method="GET">
                <input type="hidden" name="filter" value="year">
                <button type="submit" {{ $filter == 'year' ? 'style=background-color:#007bff;color:white;' : '' }}>Year</button>
            </form>
        </div>
        <canvas id="loginChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var loginData = @json($loginData);
        var filter = @json($filter);

        console.log("Login Data:", loginData);

        var labels = loginData.map(function(item) {
            if (filter === 'month') {
                var date = new Date(item.period + "-01");
                return date.toLocaleString('default', { month: 'long', year: 'numeric' });
            } else if (filter === 'year') {
                return item.period;
            } else {
                var date = new Date(item.period);
                return date.toLocaleDateString();
            }
        });

        var dataCounts = loginData.map(function(item) {
            return item.count;
        });

        var ctx = document.getElementById('loginChart').getContext('2d');
        var loginChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Logins',
                    data: dataCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: filter === 'month' ? 'Month' : filter === 'year' ? 'Year' : 'Day'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Count'
                        }
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: filter === 'month' ? 'Monthly Logins' : filter === 'year' ? 'Yearly Logins' : 'Daily Logins'
                    }
                }
            }
        });
    });
</script>
@endsection
