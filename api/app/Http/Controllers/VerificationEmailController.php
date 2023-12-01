<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerificationEmailRequest;
use App\Models\Users;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VerificationEmailController extends Controller
{
    public function verify(VerificationEmailRequest $request) {
        $user_id = Crypt::decrypt($request->identifier);
        $user = Users::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            event(new Verified($user));
        }

        return response()->success('Your email successfully verified!');
    }

    public function resend(Request $request) {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->error('Your email has already been verified!');
        }

        $user->sendEmailVerificationNotification();

        return response()->success('New verification link sent on your email');
    }
}
