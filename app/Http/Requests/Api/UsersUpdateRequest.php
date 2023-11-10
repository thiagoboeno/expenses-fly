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
            'birth_date' => 'required|dateformat:m/d/Y|before:today',
            'phone_number' => 'nullable|max:20',
        ];
    }
}