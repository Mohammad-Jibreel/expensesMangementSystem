@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Create Category</h2>

    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
</div>

@endsection
