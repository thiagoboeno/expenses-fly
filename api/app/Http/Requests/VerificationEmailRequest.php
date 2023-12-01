<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerificationEmailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'identifier' => 'required',
            'hash' => 'required',
        ];
    }
}
