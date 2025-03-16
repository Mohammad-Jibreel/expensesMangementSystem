@extends('layouts.mainLayout')

@section('content')
<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Budgets List</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <a href="{{ route('budgets.create') }}" class="btn btn-primary btn-lg mt-3">Add New Budget</a>
</div>

<!-- Budgets Table -->
<table class="table table-borderless table-striped table-earning">
    <thead>
        <tr>
            <th>#</th>
            <th>Limit</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($budgets as $budget)
        <tr>
            <td>{{ $budget->id }}</td>
            <td>${{ number_format($budget->limit, 2) }}</td>
            <td>{{ $budget->startDate }}</td>
            <td>{{ $budget->endDate }}</td>
            <td>
                <a href="{{ route('budgets.edit', $budget->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="d-flex justify-content-center mt-4">
    {{ $budgets->links('pagination::bootstrap-5') }}
</div>

@endsection
