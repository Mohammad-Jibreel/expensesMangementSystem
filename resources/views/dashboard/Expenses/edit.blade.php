@extends('layouts.mainLayout')

@section('content')
<div class="container">
    <h2>Edit Expense</h2>
    <form action="{{ route('expenses.update', $expense->expenseID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="number" name="amount" class="form-control" value="{{ $expense->amount }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $expense->date }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" name="description" class="form-control" value="{{ $expense->description }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Expense</button>
    </form>
</div>
@endsection
