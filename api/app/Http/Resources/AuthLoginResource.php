<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthLoginResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->resource,
		];
    }

    public function with($request)
	{
		return [
			'success' => true
		];
	}
}
