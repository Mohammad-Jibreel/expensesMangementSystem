@extends('layouts.mainLayout')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">Financial Reports</h2>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('report.index') }}" class="mb-4">
        <div class="row">
            <!-- From Month & Year -->
            <div class="col-md-2">
                <label for="from_month" class="form-label">From Month </label>
                <select name="from_month" id="from_month" class="form-control">
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ $m == $fromMonth ? 'selected' : '' }}>
                            {{ date("F", mktime(0,0,0,$m,1)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="from_year" class="form-label">From Year</label>
                <select name="from_year" id="from_year" class="form-control">
                    @foreach(range(Carbon\Carbon::now()->year-5, Carbon\Carbon::now()->year) as $y)
                        <option value="{{ $y }}" {{ $y == $fromYear ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- To Month & Year -->
            <div class="col-md-2">
                <label for="to_month" class="form-label">To Month </label>
                <select name="to_month" id="to_month" class="form-control">
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ $m == $toMonth ? 'selected' : '' }}>
                            {{ date("F", mktime(0,0,0,$m,1)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="to_year" class="form-label">To Year</label>
                <select name="to_year" id="to_year" class="form-control">
                    @foreach(range(Carbon\Carbon::now()->year-5, Carbon\Carbon::now()->year) as $y)
                        <option value="{{ $y }}" {{ $y == $toYear ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Category Filter -->
            <div class="col-md-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Choose Category Name</option>
                    @foreach(App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}" {{ ($category_id == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class=" d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>

        </div>
    </form>

    <!-- Comparison Table -->
    <h4>Comparison of expenses for the specified month</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Category</th>
                <th>Total Expenses (Period One)</th>
                <th>Total Expenses (Period Two)</th>
                <th>Difference</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($currentMonthExpenses as $current)
                @php
                    $previous = $previousMonthExpenses->where('category_id', $current->category_id)->first();
                    $previousTotal = $previous ? $previous->total : 0;
                    $difference = $current->total - $previousTotal;
                @endphp
                <tr>
                    <td>{{ $current->category->category_name }}</td>
                    <td>${{ number_format($current->total, 2) }}</td>
                    <td>${{ number_format($previousTotal, 2) }}</td>
                    <td class="{{ $difference > 0 ? 'text-danger' : 'text-success' }}">
                        {{ $difference > 0 ? '+' : '' }}${{ number_format($difference, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Flow Chart for Top 5 Expenses -->
    <h4 class="mt-5">Top 5 Expenses Incurred During the Period (Flow Chart)</h4>
    @if($topExpenses->isEmpty())
    <p class="text-danger">No expenses recorded for this period.</p>
@else
    <canvas id="topExpensesChart"></canvas>
@endif

</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    console.log("Script Loaded!");

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

        console.log("Labels:", labels);
        console.log("Data:", data);


    if (labels.length === 0 || data.length === 0) {
        console.warn("No data available for chart.");
        return;
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'المبلغ المصروف ($)',
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

@endsection



