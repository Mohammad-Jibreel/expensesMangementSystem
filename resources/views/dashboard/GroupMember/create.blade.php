@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Add Group Member</h2>

    <form action="{{ route('group-members.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="group_id">Group</label>
            <select name="group_id" class="form-control" required>
                @foreach($groups as $group)
                <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="user_id">User</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Member</button>
    </form>
</div>

@endsection
