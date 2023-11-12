<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->string('first_name', 100)->nullable()->default(null);
            $table->string('last_name', 100)->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->date('birth_date')->nullable()->default(null);
            $table->string('phone_number', 20)->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
