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
    Schema::create('tref_signatures', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('prefixes', 50)->nullable();
      $table->string('suffixes', 50)->nullable();
      $table->string('position');
      $table->string('image')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tref_signatures');
  }
};
