@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Add New Group Expense</h2>

    <form action="{{ route('group-expenses.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="description">Expense Description</label>
            <input type="text" name="description" id="description" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="group_id">Group</label>
            <select name="group_id" id="group_id" class="form-control" required>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Expense</button>
    </form>
</div>

@endsection
