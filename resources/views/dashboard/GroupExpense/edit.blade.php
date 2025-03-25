@extends('layouts.mainLayout')

@section('content')

<div class="p-2 m-2">
    <h2 class="mb-3 text-primary">Edit Group Expense</h2>

    <form action="{{ route('group-expenses.update', $groupExpense) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="description">Expense Description</label>
            <input type="text" name="description" value="{{ old('description', $groupExpense->description) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" value="{{ old('amount', $groupExpense->amount) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="group_id">Group</label>
            <select name="group_id" id="group_id" class="form-control" required>
                @foreach($groups as $group) <!-- Make sure you're passing all groups to the view -->
                    <option value="{{ $group->id }}" {{ $group->id == $groupExpense->group_id ? 'selected' : '' }}>
                        {{ $group->group_name }}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Update Group Expense</button>
    </form>
</div>

@endsection
