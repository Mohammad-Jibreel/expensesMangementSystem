@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">إضافة هدف توفير جديد</h1>

    <form action="{{ route('savings.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block">المبلغ المستهدف (ريال):</label>
            <input type="number" name="target_amount" class="border p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label class="block">المدة:</label>
            <select name="duration" class="border p-2 w-full" required>
                <option value="شهري">شهري</option>
                <option value="6 أشهر">6 أشهر</option>
                <option value="سنوي">سنوي</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">إضافة الهدف</button>
    </form>
</div>
@endsection
