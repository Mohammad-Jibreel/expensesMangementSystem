@extends('layouts.mainLayout')

@section('content')
<div class="container">
    <h2>Add Expense</h2>
    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="number" name="amount" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" name="description" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Expense</button>
    </form>
</div>
@endsection
