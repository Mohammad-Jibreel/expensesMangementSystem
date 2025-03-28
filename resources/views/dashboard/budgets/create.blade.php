@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Add Budget</h2>

    <form action="{{ route('budgets.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="salary" class="form-label">Salary</label>
            <input type="number" step="0.01" class="form-control" name="salary" required>
        </div>

        <div class="mb-3">
            <label for="month" class="form-label">Month</label>
            <select class="form-control @error('month') is-invalid @enderror" name="month" required>
                @foreach(range(1,12) as $m)
                    <option value="{{ $m }}">{{ date("F", mktime(0, 0, 0, $m, 1)) }}</option>
                @endforeach

            </select>
  @error('month')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror


        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Year</label>
            <select class="form-control @error('year') is-invalid @enderror" name="year" required>
                @foreach(range(date('Y') - 10, date('Y')) as $y)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endforeach
            </select>



        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

@endsection
