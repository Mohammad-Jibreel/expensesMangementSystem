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
            <label for="monthly_income" class="form-label">Monthly Income</label>
            <input type="number" step="0.01" class="form-control" name="monthly_income" value="{{ old('monthly_income', $savingsGoal->monthly_income) }}" required>
        </div>

        <div class="mb-3">
            <label for="saving_percentage" class="form-label">Saving Percentage</label>
            <select name="saving_percentage" class="form-control" required>
                <option value="5" {{ old('saving_percentage', $savingsGoal->saving_percentage) == 5 ? 'selected' : '' }}>5%</option>
                <option value="10" {{ old('saving_percentage', $savingsGoal->saving_percentage) == 10 ? 'selected' : '' }}>10%</option>
                <option value="15" {{ old('saving_percentage', $savingsGoal->saving_percentage) == 15 ? 'selected' : '' }}>15%</option>
                <option value="20" {{ old('saving_percentage', $savingsGoal->saving_percentage) == 20 ? 'selected' : '' }}>20%</option>
            </select>
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
