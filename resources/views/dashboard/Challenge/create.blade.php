@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Create New Challenge</h2>

    <form action="{{ route('challenges.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="challenge_name">Challenge Name</label>
            <input type="text" name="challenge_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="points">Points</label>
            <input type="number" name="points" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Challenge</button>
    </form>
</div>

@endsection
