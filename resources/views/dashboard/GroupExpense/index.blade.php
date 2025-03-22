@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Group Expenses</h2>

    <!-- Add Button to Navigate to Create Form -->
    <a href="{{ route('group-expenses.create') }}" class="btn btn-primary btn-lg mb-3">Add New Expense</a>

    <table class="table table-borderless table-striped table-earning mt-2">
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Group</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->id }}</td>
                <td>{{ $expense->description }}</td>
                <td>${{ number_format($expense->amount, 2) }}</td>
                <td>{{ $expense->group->group_name }}</td>
                <td>
                    <a href="{{ route('group-expenses.show', $expense->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('group-expenses.edit', $expense->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('group-expenses.destroy', $expense->id) }}" method="POST" class="d-inline">
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
