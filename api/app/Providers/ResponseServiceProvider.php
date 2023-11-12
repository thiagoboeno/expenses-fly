<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('success', function ($message, $status = 200) {
            $response = [
                'message' => $message,
                'success' => true
            ];

            return response()->json($response, $status);
        });

        Response::macro('error', function ($message, $status = 400) {
            $response = [
                'message' => $message,
                'success' => false
            ];

            return response()->json($response, $status);
        });
    }
}
