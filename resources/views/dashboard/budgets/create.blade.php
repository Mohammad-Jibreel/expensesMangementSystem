@extends('layouts.mainLayout')

@section('content')

<div class="container">
    <h2 class="mb-3">Create New Budget</h2>

    <form method="POST" action="{{ route('budgets.store') }}">
        @csrf
        <div class="mb-3">
            <label for="limit" class="form-label">Budget Limit</label>
            <input type="number" class="form-control" id="limit" name="limit" required>
        </div>

        <div class="mb-3">
            <label for="startDate" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="startDate" name="startDate" required>
        </div>

        <div class="mb-3">
            <label for="endDate" class="form-label">End Date</label>
            <input type="date" class="form-control" id="endDate" name="endDate" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Budget</button>
    </form>
</div>

@endsection
