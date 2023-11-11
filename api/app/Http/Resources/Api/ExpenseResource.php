<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user->first_name,
            'description' => $this->description,
            'value' => $this->value,
            'date' => $this->date,
        ];
    }

    public function with($request)
	{
		return [
			'success' => true
		];
	}
}
