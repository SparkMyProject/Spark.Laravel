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
      Schema::table('permissions', function (Blueprint $table) {
        $table->string('description')->nullable();
      });
      Schema::table('roles', function (Blueprint $table) {
        $table->string('description')->nullable();
        $table->string('icon')->nullable()->default('fa-regular fa-user');
        $table->integer('priority')->default(1);
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('permissions', function (Blueprint $table) {
        $table->dropColumn('description');
      });
      Schema::table('roles', function (Blueprint $table) {
        $table->dropColumn('description');
        $table->string('icon')->nullable();

      });

    }
};
