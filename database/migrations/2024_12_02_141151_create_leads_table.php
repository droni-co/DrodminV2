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
    Schema::create('leads', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('site_id')->constrained()->onDelete('cascade');
      $table->uuid('user_id')->nullable();
      $table->string('name')->nullable();
      $table->string('email')->nullable();
      $table->string('phone')->nullable();
      $table->string('location')->nullable();
      $table->string('subject')->nullable();
      $table->string('message')->nullable();
      $table->string('referrer')->nullable();
      $table->text('info')->nullable();
      $table->text('comments')->nullable();
      $table->string('status')->default('new');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('leads');
  }
};
