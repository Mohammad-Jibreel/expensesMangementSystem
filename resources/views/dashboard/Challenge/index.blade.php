@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Challenges List</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <a href="{{ route('challenges.create') }}" class="btn btn-primary btn-lg mt-3">Create New Challenge</a>

    <table class="table table-borderless table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Challenge Name</th>
                <th>Points</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($challenges as $challenge)
            <tr>
                <td>{{ $challenge->id }}</td>
                <td>{{ $challenge->challenge_name }}</td>
                <td>{{ $challenge->points }}</td>
                <td>
                    <a href="{{ route('challenges.show', $challenge->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('challenges.edit', $challenge->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('challenges.destroy', $challenge->id) }}" method="POST" class="d-inline">
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
