@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Group Members</h2>

    <table class="table table-borderless table-striped table-earning mt-2">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Group</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->user->name }}</td>
                <td>{{ $member->group->group_name }}</td>
                <td>
                    <a href="{{ route('group-members.show', $member->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('group-members.edit', $member->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('group-members.destroy', $member->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
