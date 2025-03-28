@extends('layouts.mainLayout')

@section('content')
<div class="container">
    <h2>Add Expense</h2>
    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf




        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" required>
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>
        <div class="mb-3">
            <label class="form-label">Entry Date</label>
            <input type="date" name="date" class="form-control" >
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <input type="text" name="description" class="form-control" >
        </div>
        <div class="form-group">
            <label for="category_id">Expense Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" >
                    {{ $category->category_name }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add Expense</button>
    </form>
</div>
@endsection
