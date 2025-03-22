@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Edit Group</h2>

    <form action="{{ route('groups.update', $group->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="group_name">Group Name</label>
            <input type="text" name="group_name" value="{{ old('group_name', $group->group_name) }}" class="form-control" required>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Update Group</button>
    </form>
</div>

@endsection
