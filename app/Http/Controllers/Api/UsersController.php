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
        $users = Users::all();

        return UsersResource::collection($users);
    }

    public function show(Request $request, Users $user)
    {
        return new UsersResource($user);
    }

    public function store(UsersStoreRequest $request)
    {
        Users::create([
            ...$request->all(),
            'birth_date' => $request->has('date') ? Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d') : null,
        ]);

        return response()->success('User successfully created!');
    }

    public function update(UsersUpdateRequest $request, Users $user)
    {
        $user->update([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->has('date') ? Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d') : null,
            'phone_number' => $request->phone_number,
        ]);

        return response()->success('User successfully updated!');
    }

    public function destroy(Request $request, Users $user)
    {
        $user->delete();

        return response()->success('User successfully deleted!');
    }
}
