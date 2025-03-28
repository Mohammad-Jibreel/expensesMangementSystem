@extends('layouts.mainLayout')
@section('content')
<div class="container">
    <h2>Budgets</h2>
    <a href="{{ route('budgets.create') }}" class="btn btn-primary mb-2">Add New Budget</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-borderless table-striped table-earning">
        <thead>
            <tr>
                <th>Month</th>
                <th>Year</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($budgets as $budget)
            <tr>
                <td>{{ $budget->month }}</td>
                <td>{{ $budget->year }}</td>
                <td>{{ $budget->salary }}</td>
                <td>
                    <a href="{{ route('budgets.edit', $budget->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete budget?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
