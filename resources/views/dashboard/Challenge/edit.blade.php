@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Edit Challenge</h2>

    <form action="{{ route('challenges.update', $challenge->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="challenge_name">Challenge Name</label>
            <input type="text" name="challenge_name" value="{{ old('challenge_name', $challenge->challenge_name) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="points">Points</label>
            <input type="number" name="points" value="{{ old('points', $challenge->points) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Challenge</button>
    </form>
</div>

@endsection
