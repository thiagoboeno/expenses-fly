<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UsersStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|max:255',
            'first_name' => 'nullable|max:100',
            'last_name' => 'nullable|max:100',
            'birth_date' => 'required|dateformat:d/m/Y|before:today',
            'phone_number' => 'nullable|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.unique' => 'The email must be unique.',
            'email.max' => 'The email must be at least :max characters.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters.',
            'password.max' => 'The password must be at least :max characters.',
            'first_name.max' => 'The first name must be at least :max characters.',
            'last_name.max' => 'The last name must be at least :max characters.',
            'date.dateformat' => 'The date must be d/m/Y format.',
            'date.before' => 'The date must be before today.',
            'phone_number.max' => 'The last name must be at least :max characters.',
        ];
    }
}
