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
    Schema::create('tm_trainings', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('image')->nullable();
      $table->string('description')->nullable();
      $table->string('t_type');
      $table->date('t_date');
      $table->string('meet_link')->nullable();
      $table->boolean('status')->default(0);
      $table->integer('speaker_id');
      $table->integer('moderator_id');
      $table->integer('colab_id')->nullable();
      // $table->string('t_code', 10);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tm_trainings');
  }
};
