@extends('frontend.layout.mainLayout')

@section('content')

<div class="container">
    <h2>Expenses List</h2>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>
    <table class="table mt-3">
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
</div>

@endsection
