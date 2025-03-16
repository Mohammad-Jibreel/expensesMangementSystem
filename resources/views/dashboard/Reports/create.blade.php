@extends('layouts.mainLayout')

@section('content')
<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Create Report</h2>

    <form action="{{ route('report.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="totalExpenses">Total Expenses</label>
            <input type="number" name="totalExpenses" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="totalIncome">Total Income</label>
            <input type="number" name="totalIncome" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="netBalance">Net Balance</label>
            <input type="number" name="netBalance" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="startDate">Start Date</label>
            <input type="date" name="startDate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="endDate">End Date</label>
            <input type="date" name="endDate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Report</button>
    </form>
</div>
@endsection
