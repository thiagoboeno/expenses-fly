<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Expenses;
use App\Models\Users;
use App\Policies\ExpensesPolicy;
use App\Policies\UsersPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Expenses::class => ExpensesPolicy::class,
        Users::class => UsersPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function ($user, string $token) {
            $clientUrl = env('CLIENT_URL', 'http://localhost:3000');

            return "$clientUrl/reset-password/$token";
        });
    }
}
