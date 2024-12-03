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
    Schema::create('course_answers', function (Blueprint $table) {
      $table->uuid();
      $table->foreignUuid('question_id')->constrained()->onDelete('cascade');
      $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
      $table->string('multiple_answer')->nullable();
      $table->longtext('activity_answur')->nullable();
      $table->text('feedback')->nullable();
      $table->boolean('correct')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('course_answers');
  }
};
