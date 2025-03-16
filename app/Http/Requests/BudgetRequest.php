<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'limit' => 'required|numeric|min:0',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ];
    }

    public function messages()
    {
        return [
            'limit.required' => 'The budget limit is required.',
            'startDate.required' => 'The start date is required.',
            'endDate.required' => 'The end date is required.',
            'endDate.after_or_equal' => 'The end date must be after or equal to the start date.',
        ];
    }
}
