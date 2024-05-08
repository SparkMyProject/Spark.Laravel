<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOauthUsersTable extends Migration
{
  public function up()
  {
    Schema::create('oauth_users', function (Blueprint $table) {
      $table->id();
      $table->string('provider_id');
      $table->string('email')->nullable();
      $table->string('username')->nullable();
      $table->string('avatar')->nullable();
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('oauth_users');
  }
}
