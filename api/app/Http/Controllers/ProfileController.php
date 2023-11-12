<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\UsersUpdateRequest;
use App\Http\Resources\Api\UsersResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        try {
            return new UsersResource($request->user());
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(UsersUpdateRequest $request)
    {
        try {
            $user = $request->user();

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->has('birth_date') ? Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d') : null,
                'phone_number' => $request->phone_number,
            ]);

            return new UsersResource($user);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
