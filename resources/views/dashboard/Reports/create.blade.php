@extends('layouts.mainLayout')

@section('content')
<div class="container p-4">
    <h2 class="text-primary mb-3">Add Saving Goal</h2>

    <form action="{{ route('saving-goals.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="goal_name" class="form-label">Goal Name (e.g. New Phone, Laptop)</label>
            <input type="text" class="form-control" name="goal_name" required>
        </div>

        <div class="mb-3">
            <label for="target_amount" class="form-label">Target Amount</label>
            <input type="number" step="0.01" class="form-control" name="target_amount" required>
        </div>

        <div class="mb-3">
            <label for="saved_amount" class="form-label">Saved Amount</label>
            <input type="number" step="0.01" class="form-control" name="saved_amount" required>
        </div>

        <div class="mb-3">
            <label for="remaining_months" class="form-label">Remaining Months</label>
            <input type="number" class="form-control" name="remaining_months" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Goal</button>
    </form>
</div>
@endsection
