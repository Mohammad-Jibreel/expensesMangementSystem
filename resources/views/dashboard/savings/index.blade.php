@extends('layouts.mainLayout')

@section('content')

<div class="container">
    <h2>My Savings Goals</h2>
    <a href="{{ route('savings.create') }}" class="btn btn-primary mb-2 mt-4">Add New Savings Goal</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-borderless table-striped table-earning">
        <thead>
            <tr>
                <th>Goal Name</th>
                <th>Goal Amount</th>
                <th>Remaining Months</th>
                <th>Monthly Savings</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($savingsGoals as $goal)
                <tr>
                    <td>{{ $goal->goal_name }}</td>
                    <td>${{ number_format($goal->goal_amount, 2) }}</td>
                    <td>{{ $goal->remaining_months }}</td>
                    <td>${{ number_format($goal->monthly_savings, 2) }}</td>
                    <td>
                        <a href="{{ route('savings.edit', $goal->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('savings.destroy', $goal->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this goal?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
