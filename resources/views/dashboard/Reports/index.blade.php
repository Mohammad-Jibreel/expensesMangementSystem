@extends('layouts.mainLayout')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Financial Reports</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('report.index') }}" class="mb-4">
        <div class="row">
            <!-- From Month & Year -->
            <div class="col-md-2">
                <label for="from_month" class="form-label">Month</label>
                <select name="from_month" id="from_month" class="form-control">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $m == (request()->get('from_month', date('n'))) ? 'selected' : '' }}>
                            {{ date("F", mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="from_year" class="form-label">Year</label>
                <select name="from_year" id="from_year" class="form-control">
                    @foreach(range(Carbon\Carbon::now()->year - 5, Carbon\Carbon::now()->year) as $y)
                        <option value="{{ $y }}" {{ $y == (request()->get('from_year', date('Y'))) ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Category Filter -->
            <div class="col-md-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">All Categories</option>
                    @foreach(App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}" {{ ($category_id == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </div>
    </form>

    <!-- Comparison Table -->
    @if($currentMonthExpenses->isEmpty())
    <!-- No Expenses Message -->
    <div class="alert alert-warning" role="alert">
        <strong>No expenses recorded for this period.</strong>
    </div>
@else
    <!-- Expenses Table -->
    <h4>Comparison of Expenses for Selected Month</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Category</th>
                <th>Total Expenses</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($currentMonthExpenses as $current)
                <tr>
                    <td>{{ $current->category->category_name }}</td>
                    <td>${{ number_format($current->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

    <!-- Flow Chart for Top 5 Expenses -->
    <div class="mt-5">

        @if($topExpenses->isEmpty())
        <h4 class="mb-2">Top 5 Expenses Incurred During the Period (Flow Chart)</h4>

        <div class="alert alert-warning" role="alert">
            <strong>No expenses recorded for this period.</strong>
        </div>

        @else
        <canvas id="topExpensesChart"></canvas>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var canvas = document.getElementById('topExpensesChart');
    if (!canvas) {
        console.error("Chart canvas not found!");
        return;
    }

    var ctx = canvas.getContext('2d');

    // Using JSON data sent from Laravel
    var labels = @json($topExpenses->map(function($expense) {
        return $expense->category->category_name;
    }));

    var data = @json($topExpenses->map(function($expense) {
        return $expense->amount;
    }));

    if (labels.length === 0 || data.length === 0) {
        console.warn("No data available for chart.");
        return;
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Expenses ($)',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
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
});
</script>
@endsection

