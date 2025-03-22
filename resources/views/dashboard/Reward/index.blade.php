@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Rewards List</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('rewards.create') }}" class="btn btn-primary btn-lg mt-3">Add New Reward</a>

    <table class="table table-borderless table-striped table-earning mt-2">
        <thead>
            <tr>
                <th>#</th>
                <th>Reward Name</th>
                <th>Points Required</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rewards as $reward)
                <tr>
                    <td>{{ $reward->id }}</td>
                    <td>{{ $reward->reward_name }}</td>
                    <td>{{ $reward->points }}</td>
                    <td>
                        <a href="{{ route('rewards.edit', $reward->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('rewards.destroy', $reward->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $rewards->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection
