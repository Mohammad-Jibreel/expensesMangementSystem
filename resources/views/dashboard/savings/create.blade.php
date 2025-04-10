@extends('layouts.mainLayout')

@section('content')

<div class="container">
    <h2 class="mb-3">Create Savings Goal</h2>

    <form action="{{ route('savings.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="goal_name" class="form-label">Goal Name</label>
            <input type="text" class="form-control" name="goal_name" required>
        </div>

        <div class="mb-3">
            <label for="goal_amount" class="form-label">Goal Amount</label>
            <input type="number" step="0.01" class="form-control" name="goal_amount" required>
        </div>

        <div class="mb-3">
            <label for="monthly_income" class="form-label">Monthly Income</label>
            <input type="number" step="0.01" class="form-control" name="monthly_income" required>
        </div>

        <div class="mb-3">
            <label for="saving_percentage" class="form-label">Saving Percentage</label>
            <select name="saving_percentage" class="form-control" required>
                <option value="5">5%</option>
                <option value="10">10%</option>
                <option value="15">15%</option>
                <option value="20">20%</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="budget_id" class="form-label">Select Budget</label>
            <select name="budget_id" class="form-control" required>
                @foreach ($budgets as $budget)
                    <option value="{{ $budget->id }}">
                        {{ $budget->month }}/{{ $budget->year }} ({{ $budget->salary }} د.ا)
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Savings Goal</button>
    </form>
</div>

@endsection
