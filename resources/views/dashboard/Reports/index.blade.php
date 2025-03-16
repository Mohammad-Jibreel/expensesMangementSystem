@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Reports List</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <a href="{{ route('report.create') }}" class="btn btn-primary btn-lg mt-3">Add New Report</a>

    <!-- Export Buttons -->
    <div class="mt-3">
        <a href="{{ route('reports.export.all', 'csv') }}" class="btn btn-success btn-lg">Export All (CSV)</a>
        <a href="{{ route('reports.export.all', 'pdf') }}" class="btn btn-danger btn-lg">Export All (PDF)</a>
    </div>
</div>

<table class="table table-borderless table-striped table-earning">
    <thead>
        <tr>
            <th>#</th>
            <th>Total Expenses</th>
            <th>Total Income</th>
            <th>Net Balance</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reports as $report)
        <tr>
            <td>{{ $report->reportID }}</td>
            <td>${{ number_format($report->totalExpenses, 2) }}</td>
            <td>${{ number_format($report->totalIncome, 2) }}</td>
            <td>${{ number_format($report->netBalance, 2) }}</td>
            <td>{{ $report->startDate }}</td>
            <td>{{ $report->endDate }}</td>
            <td>
                <a href="{{ route('report.show', $report->reportID) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('report.edit', $report->reportID) }}" class="btn btn-warning btn-sm">Edit</a>

                <!-- Export Individual Report -->
                <a href="{{ route('reports.export', ['id' => $report->reportID, 'format' => 'csv']) }}" class="btn btn-success btn-sm">CSV</a>
                <a href="{{ route('reports.export', ['id' => $report->reportID, 'format' => 'pdf']) }}" class="btn btn-danger btn-sm">PDF</a>

                <form action="{{ route('report.destroy', $report->reportID) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
    {{ $reports->links('pagination::bootstrap-5') }}
</div>

@endsection
