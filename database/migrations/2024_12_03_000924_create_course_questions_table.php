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
    Schema::create('course_questions', function (Blueprint $table) {
      $table->uuid();
      $table->foreignUuid('lesson_id')->constrained()->onDelete('cascade');
      $table->string('name');
      $table->text('question')->nullable();
      $table->boolean('multiple')->default(true);
      $table->string('resA')->nullable();
      $table->string('resB')->nullable();
      $table->string('resC')->nullable();
      $table->string('resD')->nullable();
      $table->string('resE')->nullable();
      $table->integer('correct')->default('A');
      $table->integer('wons')->default(0);
      $table->integer('loses')->default(0);
      $table->float('rate', 5, 2)->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('course_questions');
  }
};
