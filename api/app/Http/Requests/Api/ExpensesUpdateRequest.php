<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ExpensesUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => 'required|max:191',
            'date' => 'required|dateformat:d/m/Y|before:today',
            'value' => 'required|numeric|min:0|between:0,99999999.99',
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'The description field is required.',
            'description.max' => 'The description must be at least :max characters.',
            'date.required' => 'The date field is required.',
            'date.dateformat' => 'The date must be d/m/Y format.',
            'date.before' => 'The date must be before today.',
            'value.required' => 'The value field is required.',
            'value.numeric' => 'The value field must be a valid numeric.',
            'value.min' => 'The value must be at least :min.',
            'value.between' => 'The value must be between :min and :max.',
        ];
    }
}
