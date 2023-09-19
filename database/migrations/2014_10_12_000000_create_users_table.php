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
        
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->string('username', 50)->primary();
                $table->string('first_name', 25);
                $table->string('last_name', 25);
                $table->string('department', 2)->nullable();
                $table->string('organize', 25)->nullable();
                $table->string('email', 30)->nullable()->unique();
                // $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                // $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
