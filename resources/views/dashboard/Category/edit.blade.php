@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Edit Category</h2>

    <form action="{{ route('category.update', $category->categoryID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" value="{{ $category->categoryName }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>

@endsection
