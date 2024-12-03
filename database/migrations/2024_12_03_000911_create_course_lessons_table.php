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
    Schema::create('course_lessons', function (Blueprint $table) {
      $table->uuid();
      $table->foreignUuid('course_id')->constrained()->onDelete('cascade');
      $table->string('slug');
      $table->unique(['course_id', 'slug']);
      $table->string('name');
      $table->string('group')->nullable();
      $table->integer('position')->default(0);
      $table->string('video')->nullable();
      $table->text('description')->nullable();
      $table->longtext('content')->nullable();
      $table->date('limit_date')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('course_lessons');
  }
};
