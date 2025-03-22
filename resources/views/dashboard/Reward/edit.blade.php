@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Edit Reward</h2>

    <form action="{{ route('rewards.update', $reward->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="reward_name">Reward Name</label>
            <input type="text" name="reward_name" value="{{ old('reward_name', $reward->reward_name) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="points">Points Required</label>
            <input type="number" name="points" value="{{ old('points_required', $reward->points) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Reward</button>
    </form>
</div>

@endsection
