@extends('layouts.mainLayout')

@section('content')

<div class="container">
    <h2 class="mb-3">Edit Budget</h2>

    <form method="POST" action="{{ route('budgets.update', $budget->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="limit" class="form-label">Budget Limit</label>
            <input type="number" class="form-control" id="limit" name="limit" value="{{ $budget->limit }}" required>
        </div>

        <div class="mb-3">
            <label for="startDate" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="startDate" name="startDate" value="{{ $budget->startDate }}" required>
        </div>

        <div class="mb-3">
            <label for="endDate" class="form-label">End Date</label>
            <input type="date" class="form-control" id="endDate" name="endDate" value="{{ $budget->endDate }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Budget</button>
    </form>
</div>

@endsection
