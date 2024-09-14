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
    Schema::create('posts', function (Blueprint $table) {
      $table->id();
      $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
      $table->foreignUuid('site_id')->constrained()->onDelete('cascade');
      $table->string('slug');
      $table->unique(['site_id', 'slug']);
      $table->string('name');
      $table->text('description')->nullable();
      $table->string('picture')->nullable();
      $table->text('content')->nullable();
      $table->string('format')->default('markdown');
      $table->json('props')->nullable();
      $table->boolean('active')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('posts');
  }
};
