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
      Schema::create('enrollments', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
        $table->foreignUuid('site_id')->constrained()->onDelete('cascade');
        $table->string('role')->default('member');
        $table->string('apikey')->nullable();
        $table->unique(['user_id', 'site_id']);
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('enrollments');
    }
};
