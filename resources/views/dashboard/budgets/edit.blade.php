@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Edit Budget</h2>

    <form method="POST" action="{{ route('budgets.update', $budget->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="salary" class="form-label">Budget Salary</label>
            <input type="number" step="0.01" class="form-control" name="salary" value="{{ $budget->salary }}" required>
        </div>

        <div class="mb-3">
            <label for="month" class="form-label">Month</label>
            <select class="form-control" name="month" required>
                @foreach(range(1,12) as $m)
                    <option value="{{ $m }}" {{ $budget->month == $m ? 'selected' : '' }}>{{ date("F", mktime(0, 0, 0, $m, 1)) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <select class="form-control" name="year" required>
                @foreach(range(date('Y') - 10, date('Y')) as $y)
                    <option value="{{ $y }}" {{ $budget->year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Budget</button>
    </form>
</div>

@endsection
