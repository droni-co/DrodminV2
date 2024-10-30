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
    Schema::create('categoryables', function (Blueprint $table) {
      $table->foreignUuid('category_id')->constrained()->onDelete('cascade');
      $table->uuidMorphs('categoryable');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('categoryables');
  }
};
