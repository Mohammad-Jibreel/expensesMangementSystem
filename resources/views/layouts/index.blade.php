@extends('layouts.mainLayout')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Total Salary Card -->
            <div class="col-sm-6 col-lg-3 mb-4 d-flex">
                <div class="overview-item overview-item--c1 shadow-lg rounded-lg bg-white p-4 w-100">
                    <div class="overview__inner text-center">
                        <div class="overview-box">
                            <div class="icon mb-3">
                                <i class="zmdi zmdi-account-o text-primary" style="font-size: 40px;"></i>
                            </div>
                            <div class="text">
                                <h2 class="text-primary">{{ number_format($salary, 2) }} د.ا</h2>
                                <span class="text-muted">إجمالي الراتب</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Expenses Card -->
            <div class="col-sm-6 col-lg-3 mb-4 d-flex">
                <div class="overview-item overview-item--c2 shadow-lg rounded-lg bg-white p-4 w-100">
                    <div class="overview__inner text-center">
                        <div class="overview-box">
                            <div class="icon mb-3">
                                <i class="zmdi zmdi-shopping-cart text-warning" style="font-size: 40px;"></i>
                            </div>
                            <div class="text">
                                <h2 class="text-warning">{{ number_format($expenses, 2) }} د.ا</h2>
                                <span class="text-muted">إجمالي المصروفات</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Savings Card -->
            <div class="col-sm-6 col-lg-3 mb-4 d-flex">
                <div class="overview-item overview-item--c3 shadow-lg rounded-lg bg-white p-4 w-100">
                    <div class="overview__inner text-center">
                        <div class="overview-box">
                            <div class="icon mb-3">
                                <i class="zmdi zmdi-calendar-note text-info" style="font-size: 40px;"></i>
                            </div>
                            <div class="text">
                                <h2 class="text-info">{{ number_format($savings, 2) }} د.ا</h2>
                                <span class="text-muted">إجمالي التوفير</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Remaining Balance Card -->
            <div class="col-sm-6 col-lg-3 mb-4 d-flex">
                <div class="overview-item overview-item--c4 shadow-lg rounded-lg bg-white p-4 w-100">
                    <div class="overview__inner text-center">
                        <div class="overview-box">
                            <div class="icon mb-3">
                                <i class="zmdi zmdi-money text-success" style="font-size: 40px;"></i>
                            </div>
                            <div class="text">
                                <h2 class="text-success">{{ number_format($remaining_balance, 2) }} د.ا</h2>
                                <span class="text-muted">إجمالي الرصيد المتبقي</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Representation of the Data -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="card shadow-lg p-4">
                    <h3 class="text-center mb-4">Financial Overview</h3>
                    <canvas id="financialChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>

<script>
    // Chart.js code to render the financial chart
    var ctx = document.getElementById('financialChart').getContext('2d');
    var financialChart = new Chart(ctx, {
        type: 'bar', // Choose your chart type (bar, line, pie, etc.)
        data: {
            labels: ['Salary', 'Expenses', 'Savings', 'Remaining Balance'],
            datasets: [{
                label: 'Amounts (د.ا)',
                data: [{{ $salary }}, {{ $expenses }}, {{ $savings }}, {{ $remaining_balance }}],
                backgroundColor: ['rgba(38, 198, 218, 0.5)', 'rgba(255, 179, 0, 0.5)', 'rgba(0, 188, 212, 0.5)', 'rgba(76, 175, 80, 0.5)'],
                borderColor: ['rgba(38, 198, 218, 1)', 'rgba(255, 179, 0, 1)', 'rgba(0, 188, 212, 1)', 'rgba(76, 175, 80, 1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection
