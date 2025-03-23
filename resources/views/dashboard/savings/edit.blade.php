@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">تعديل هدف التوفير</h1>

    <form action="{{ route('savings.update', $goal->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block">المبلغ المستهدف (ريال):</label>
            <input type="number" name="target_amount" class="border p-2 w-full" value="{{ $goal->target_amount }}" required>
        </div>

        <div class="mb-4">
            <label class="block">المدة:</label>
            <select name="duration" class="border p-2 w-full" required>
                <option value="شهري" {{ $goal->duration == 'شهري' ? 'selected' : '' }}>شهري</option>
                <option value="6 أشهر" {{ $goal->duration == '6 أشهر' ? 'selected' : '' }}>6 أشهر</option>
                <option value="سنوي" {{ $goal->duration == 'سنوي' ? 'selected' : '' }}>سنوي</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">تحديث الهدف</button>
    </form>
</div>
@endsection
