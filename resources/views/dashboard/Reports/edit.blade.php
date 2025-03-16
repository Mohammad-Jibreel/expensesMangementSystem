@extends('layouts.mainLayout')

@section('content')
<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Edit Report</h2>

    <form action="{{ route('report.update', $report->reportID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="totalExpenses">Total Expenses</label>
            <input type="number" name="totalExpenses" value="{{ old('totalExpenses', $report->totalExpenses) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="totalIncome">Total Income</label>
            <input type="number" name="totalIncome" value="{{ old('totalIncome', $report->totalIncome) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="netBalance">Net Balance</label>
            <input type="number" name="netBalance" value="{{ old('netBalance', $report->netBalance) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="startDate">Start Date</label>
            <input type="date" name="startDate" value="{{ old('startDate', $report->startDate->toDateString()) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="endDate">End Date</label>
            <input type="date" name="endDate" value="{{ old('endDate', $report->endDate->toDateString()) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Report</button>
    </form>
</div>
@endsection
