@extends('layouts.mainLayout')

@section('content')
<div class="page-container">
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="container">

            <div class="row justify-content-center">
                <!-- إجمالي الراتب -->
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="overview-item overview-item--c4 shadow-lg rounded-lg bg-light p-4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon text-center">
                                    <i class="zmdi zmdi-money text-success" style="font-size: 36px;"></i>
                                </div>
                                <div class="text text-center">
                                    <h2 class="text-success">{{ number_format($salary, 2) }} د.ا</h2>
                                    <span class="text-muted">إجمالي الراتب</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- الرسم البياني تحت الكارد -->
                    <div class="overview-chart mt-3">
                        <canvas id="widgetChart1"></canvas>
                    </div>
                </div>

                <!-- إجمالي الرصيد المتبقي -->
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="overview-item overview-item--c5 shadow-lg rounded-lg bg-light p-4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon text-center">
                                    <i class="zmdi zmdi-wallet text-warning" style="font-size: 36px;"></i>
                                </div>
                                <div class="text text-center">
                                    <h2 class="text-warning">{{ number_format($remaining_balance, 2) }} د.ا</h2>
                                    <span class="text-muted">إجمالي الرصيد المتبقي</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- الرسم البياني تحت الكارد -->
                    <div class="overview-chart mt-3">
                        <canvas id="widgetChart2"></canvas>
                    </div>
                </div>

                <!-- إجمالي التوفير -->
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="overview-item overview-item--c6 shadow-lg rounded-lg bg-light p-4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon text-center">
                                    <i class="zmdi zmdi-save text-info" style="font-size: 36px;"></i>
                                </div>
                                <div class="text text-center">
                                    <h2 class="text-info">{{ number_format($savings, 2) }} د.ا</h2>
                                    <span class="text-muted">إجمالي التوفير</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- الرسم البياني تحت الكارد -->
                    <div class="overview-chart mt-3">
                        <canvas id="widgetChart3"></canvas>
                    </div>
                </div>

                <!-- إجمالي المصروفات -->
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="overview-item overview-item--c7 shadow-lg rounded-lg bg-light p-4">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon text-center">
                                    <i class="zmdi zmdi-shopping-cart text-danger" style="font-size: 36px;"></i>
                                </div>
                                <div class="text text-center">
                                    <h2 class="text-danger">{{ number_format($expenses, 2) }} د.ا</h2>
                                    <span class="text-muted">إجمالي المصروفات</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- الرسم البياني تحت الكارد -->
                    <div class="overview-chart mt-3">
                        <canvas id="widgetChart4"></canvas>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
</div>

@endsection

@section('scripts')
<script>
    // رسم بياني لإجمالي الراتب
    var ctx1 = document.getElementById('widgetChart1').getContext('2d');
    var widgetChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['الراتب الشهري'],
            datasets: [{
                label: 'الراتب',
                data: [{{ $salary }}],
                backgroundColor: '#4CAF50',
                borderColor: '#388E3C',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // رسم بياني لإجمالي الرصيد المتبقي
    var ctx2 = document.getElementById('widgetChart2').getContext('2d');
    var widgetChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['الرصيد المتبقي'],
            datasets: [{
                label: 'الرصيد المتبقي',
                data: [{{ $remaining_balance }}],
                backgroundColor: '#FF9800',
                borderColor: '#F57C00',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // رسم بياني لإجمالي التوفير
    var ctx3 = document.getElementById('widgetChart3').getContext('2d');
    var widgetChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['إجمالي التوفير'],
            datasets: [{
                label: 'التوفير',
                data: [{{ $savings }}],
                backgroundColor: '#03A9F4',
                borderColor: '#0288D1',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // رسم بياني لإجمالي المصروفات
    var ctx4 = document.getElementById('widgetChart4').getContext('2d');
    var widgetChart4 = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: ['المصروفات'],
            datasets: [{
                label: 'المصروفات',
                data: [{{ $expenses }}],
                backgroundColor: '#F44336',
                borderColor: '#D32F2F',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection
