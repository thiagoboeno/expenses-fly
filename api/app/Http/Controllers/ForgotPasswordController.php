<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Models\Users;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                return response()->success('Forgot Password link has been sended to your email!');
            } else {
                return response()->error('Forgot Password link can\'t been sended! Please, try again later!');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (Users $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return response()->success('Your Password has been changed!');
            } else {
                return response()->error('Your Password can\'t been updated! Check if token is correct and try again later!');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
