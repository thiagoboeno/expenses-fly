<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthSignUpRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\AuthLoginResource;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->error('E-mail or password is incorrect!');
        }

        $token = $request->user()->createToken($request->userAgent())->plainTextToken;

        return new AuthLoginResource($token);
    }

    public function signUp(AuthSignUpRequest $request)
    {
        $user = Users::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        $token = $user->createToken($request->userAgent())->plainTextToken;

        return new AuthLoginResource($token);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->success('User successfully logout!');
    }

    // public function logoutDevice(Request $request)
    // {
    //     $request->user()->tokens()->where('id', $request->devide_name)->delete();

    //     return response()->success('Device successfully logout!');
    // }

    // public function logoutAllDevices(Request $request)
    // {
    //     $request->user()->tokens()->delete();

    //     return response()->success('All devices successfully logout!');
    // }
}
