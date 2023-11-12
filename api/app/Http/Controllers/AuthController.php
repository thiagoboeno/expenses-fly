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
        try {
            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->error('E-mail or password is incorrect!');
            }

            $token = $request->user()->createToken($request->userAgent())->plainTextToken;

            return new AuthLoginResource($token);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function signUp(AuthSignUpRequest $request)
    {
        try {
            $user = Users::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
            ]);

            $token = $user->createToken($request->userAgent())->plainTextToken;

            return new AuthLoginResource($token);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->success('User successfully logout!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
