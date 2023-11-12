<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'nullable|max:100',
            'last_name' => 'nullable|max:100',
            'birth_date' => 'nullable|dateformat:d/m/Y|before:today',
            'phone_number' => 'nullable|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.max' => 'The first name must be at least :max characters.',
            'last_name.max' => 'The last name must be at least :max characters.',
            'date.dateformat' => 'The date must be d/m/Y format.',
            'date.before' => 'The date must be before today.',
            'phone_number.max' => 'The last name must be at least :max characters.',
        ];
    }
}
