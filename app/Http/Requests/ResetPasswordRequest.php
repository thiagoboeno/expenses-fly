<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|confirmed',
        ];
    }
}
