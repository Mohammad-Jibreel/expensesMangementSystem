@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Create Reward</h2>

    <form action="{{ route('rewards.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="reward_name">Reward Name</label>
            <input type="text" name="reward_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="points_required">Points Required</label>
            <input type="number" name="points" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Reward</button>
    </form>
</div>

@endsection
