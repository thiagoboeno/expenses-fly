<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthSignUpRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|max:255',
            'first_name' => 'nullable|max:100',
            'last_name' => 'nullable|max:100',
        ];
    }
}
