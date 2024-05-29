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
      Schema::create('user_timeline', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id');
        $table->json('events')->nullable()->change();
        $table->timestamps();

      });

      Schema::create('user_timeline_events', function (Blueprint $table) {
        $table->id();
        $table->foreignId('timeline_id');
        $table->string('title', 128);
        $table->string('description', 128);
        $table->string('color', 128);
        $table->json('data')->nullable()->change();
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('user_timeline');
      Schema::dropIfExists('user_timeline_events');
    }
};
