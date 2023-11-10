<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ExpensesUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => 'required|max:191',
            'date' => 'required|dateformat:m/d/Y|before:today',
            'value' => 'required|numeric|min:0|between:0,99999999.99',
        ];
    }
}
