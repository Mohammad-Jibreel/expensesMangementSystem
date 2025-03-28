@extends('layouts.mainLayout')

@section('content')

<div class="container">
    <h2 class="mb-3">Edit Savings Goal</h2>

    <form action="{{ route('savings.update', $savingsGoal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="goal_name" class="form-label">Goal Name</label>
            <input type="text" class="form-control" name="goal_name" value="{{ old('goal_name', $savingsGoal->goal_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="goal_amount" class="form-label">Goal Amount</label>
            <input type="number" step="0.01" class="form-control" name="goal_amount" value="{{ old('goal_amount', $savingsGoal->goal_amount) }}" required>
        </div>

        <div class="mb-3">
            <label for="remaining_months" class="form-label">Remaining Months</label>
            <input type="number" class="form-control" name="remaining_months" value="{{ old('remaining_months', $savingsGoal->remaining_months) }}" required>
        </div>

        <div class="mb-3">
            <label for="budget_id" class="form-label">Select Budget</label>
            <select class="form-control" name="budget_id" required>
                @foreach(auth()->user()->budgets as $budget)
                    <option value="{{ $budget->id }}" {{ $savingsGoal->budget_id == $budget->id ? 'selected' : '' }}>
                        {{ date("F", mktime(0, 0, 0, $budget->month, 1)) }} - {{ $budget->year }} , {{ $budget->salary }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Savings Goal</button>
    </form>
</div>

@endsection
