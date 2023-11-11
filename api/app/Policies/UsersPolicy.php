<?php

namespace App\Policies;

use App\Models\Users;
use Illuminate\Auth\Access\Response;

class UsersPolicy
{
    public function isOwnerUser(?Users $authUser, Users $user)
    {
        if ($authUser?->id === $user->id) {
            return Response::allow();
        } else {
            return Response::deny('You aren\'t the owner of this account and can\'t perform this action!');
        }
    }
}
