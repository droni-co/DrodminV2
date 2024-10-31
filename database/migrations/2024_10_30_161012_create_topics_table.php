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
    Schema::create('topics', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
      $table->foreignUuid('site_id')->constrained()->onDelete('cascade');
      $table->string('slug')->unique();
      $table->unique(['site_id', 'slug']);
      $table->string('name');
      $table->string('group')->nullable();
      $table->longText('content')->nullable();
      $table->datetime('approved_at')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('topics');
  }
};
