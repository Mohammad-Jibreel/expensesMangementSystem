@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">أهداف التوفير</h1>

    @if (session('success'))
        <div class="bg-green-200 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('savings.store') }}" method="POST" class="mb-4">
        @csrf
        <label class="block">الهدف المالي:</label>
        <input type="number" name="target_amount" class="border p-2 w-full" required>

        <label class="block mt-2">المدة:</label>
        <select name="duration" class="border p-2 w-full">
            <option value="شهري">شهري</option>
            <option value="6 أشهر">6 أشهر</option>
            <option value="سنوي">سنوي</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-3">إضافة هدف</button>
    </form>

    <h2 class="text-xl font-semibold mt-6">الأهداف الحالية</h2>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">المبلغ المستهدف</th>
                <th class="px-4 py-2">المدخر</th>
                <th class="px-4 py-2">المدة</th>
                <th class="px-4 py-2">التقدم</th>
            </tr>
        </thead>
        <tbody>
            @foreach($goals as $goal)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $goal->target_amount }} ريال</td>
                <td class="px-4 py-2">{{ $goal->saved_amount }} ريال</td>
                <td class="px-4 py-2">{{ $goal->duration }}</td>
                <td class="px-4 py-2">
                    <progress value="{{ $goal->saved_amount }}" max="{{ $goal->target_amount }}"></progress>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
