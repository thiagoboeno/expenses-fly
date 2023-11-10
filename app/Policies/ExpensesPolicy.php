<?php

namespace App\Policies;

use App\Models\Expenses;
use App\Models\Users;
use Illuminate\Auth\Access\Response;

class ExpensesPolicy
{
    public function isExpenseOwnerUser(?Users $user, Expenses $expense)
    {
        if ($user?->id === $expense->user_id) {
            return Response::allow();
        } else {
            return Response::deny('You aren\'t the owner of this expense and can\'t perform this action!');
        }
    }
}
