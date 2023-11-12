<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UsersStoreRequest;
use App\Http\Requests\Api\UsersUpdateRequest;
use App\Http\Resources\Api\UsersResource;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:isOwnerUser,user')->only(['show', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        try {
            $users = Users::all();

            return UsersResource::collection($users);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function show(Request $request, Users $user)
    {
        try {
            return new UsersResource($user);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(UsersStoreRequest $request)
    {
        try {
            Users::create([
                ...$request->all(),
                'birth_date' => $request->has('birth_date') ? Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d') : null,
            ]);

            return response()->success('User successfully created!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(UsersUpdateRequest $request, Users $user)
    {
        try {
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->has('birth_date') ? Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d') : null,
                'phone_number' => $request->phone_number,
            ]);

            return response()->success('User successfully updated!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Request $request, Users $user)
    {
        try {
            $user->delete();

            return response()->success('User successfully deleted!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
