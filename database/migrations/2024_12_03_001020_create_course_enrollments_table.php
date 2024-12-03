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
    Schema::create('course_enrollments', function (Blueprint $table) {
      $table->uuid();
      $table->foreignUuid('course_id')->constrained()->onDelete('cascade');
      $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
      $table->unique(['course_id', 'user_id']);
      $table->string('role')->default('student');
      $table->boolean('completed')->default(false);
      $table->integer('progress')->default(0);
      $table->integer('score')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('course_enrollments');
  }
};
