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
            $table->string('first_name', 128)->nullable();
            $table->string('last_name', 128)->nullable();
            $table->string('email', 128)->unique()->nullable();
            $table->string('username', 20)->unique();
            $table->string('display_name', 30)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->default('assets/img/avatars/1.png');
            $table->string('status', 30)->default('Relaxing...')->nullable();
            $table->enum('timezone', ['EST', 'UTC', 'AEST', 'CST', 'PST'])->default('UTC');
            $table->enum('account_status', ['Active', 'Disabled', 'Banned'])->default('Active');
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
