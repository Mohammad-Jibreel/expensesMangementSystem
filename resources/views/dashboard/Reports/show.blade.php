@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Report Details</h2>
    <table class="table table-borderless table-striped table-earning">
        <tr><th>Report ID</th><td>{{ $report->reportID }}</td></tr>
        <tr><th>User ID</th><td>{{ $report->userID }}</td></tr>
        <tr><th>Total Expenses</th><td>${{ number_format($report->totalExpenses, 2) }}</td></tr>
        <tr><th>Total Income</th><td>${{ number_format($report->totalIncome, 2) }}</td></tr>
        <tr><th>Net Balance</th><td>${{ number_format($report->netBalance, 2) }}</td></tr>
        <tr><th>Start Date</th><td>{{ $report->startDate }}</td></tr>
        <tr><th>End Date</th><td>{{ $report->endDate }}</td></tr>
    </table>

    <a href="{{ route('reports.export', $report->reportID) }}" class="btn btn-primary">Export to CSV</a>
    <a href="{{ route('reports.export.pdf', $report->reportID) }}" class="btn btn-danger">Export to PDF</a>
</div>
@endsection
