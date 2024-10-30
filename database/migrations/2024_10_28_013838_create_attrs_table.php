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
    Schema::create('attrs', function (Blueprint $table) {
      $table->id();
      $table->foreignUuid('site_id')->constrained()->onDelete('cascade');
      $table->uuidMorphs('attributable');
      $table->string('name');
      $table->string('type')->default('string');
      $table->string('value');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('attrs');
  }
};
