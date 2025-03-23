@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">

    <h2 class="mb-3 text-primary">Expenses List</h2>

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

    <a href="{{ route('expenses.create') }}" class="btn btn-primary btn-lg mt-3">Add New Expense</a>
    <button id="start-record" type="button" class="px-4 py-2 bg-blue-600 text-black rounded-lg shadow-md">
        🎤 Start Listening
    </button>
</div>

<!-- Expenses Table -->
<table class="table table-borderless table-striped table-earning">
    <thead>
        <tr>
            <th>#</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expenses as $expense)
        <tr>
            <td>{{ $expense->expenseID }}</td>
            <td>${{ number_format($expense->amount, 2) }}</td>
            <td>{{ $expense->date }}</td>
            <td>{{ $expense->description }}</td>
            <td>


                <!-- Edit and Delete Buttons -->
                <a href="{{ route('expenses.edit', $expense->expenseID) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('expenses.destroy', $expense->expenseID) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>



        @endforeach
    </tbody>
</table>

<!-- Pagination Links with Custom Styling -->
<div class="d-flex justify-content-center mt-4">
    {{ $expenses->links('pagination::bootstrap-5') }}
</div>

@endsection
