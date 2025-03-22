@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Create New Group</h2>

    <form action="{{ route('groups.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="group_name">Group Name</label>
            <input type="text" name="group_name" class="form-control" required>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Create Group</button>
    </form>
</div>

@endsection
