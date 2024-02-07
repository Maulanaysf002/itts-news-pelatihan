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
    Schema::create('tas_training_moderators', function (Blueprint $table) {
      $table->id();
      $table->integer('moderator_id');
      $table->bigInteger('training_id');
      $table->string('invitation_code', 50)->default(0);
      $table->string('certificate_code', 50)->default(0);
      $table->boolean('presence')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tas_training_moderators');
  }
};
