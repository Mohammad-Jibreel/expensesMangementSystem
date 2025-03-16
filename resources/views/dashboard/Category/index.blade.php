@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Categories List</h2>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <a href="{{ route('category.create') }}" class="btn btn-primary btn-lg mt-3">Add New Category</a>
</div>

<!-- Categories Table -->
<table class="table table-borderless table-striped table-earning">
    <thead>
        <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->categoryID }}</td>
            <td>{{ $category->categoryName }}</td>
            <td>
                <a href="{{ route('category.edit', $category->categoryID) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('category.destroy', $category->categoryID) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="d-flex justify-content-center mt-4">
    {{ $categories->links('pagination::bootstrap-5') }}
</div>

@endsection
