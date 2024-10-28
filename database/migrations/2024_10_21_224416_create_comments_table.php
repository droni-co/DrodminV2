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
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->foreignUuid('site_id')->constrained()->onDelete('cascade');
      $table->nullableMorphs('commentable');
      $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
      $table->integer('parent_id')->nullable();
      $table->text('content');
      $table->datetime('approved_at')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('comments');
  }
};
