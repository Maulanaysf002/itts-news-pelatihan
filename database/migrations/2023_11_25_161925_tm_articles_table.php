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
    Schema::create('tm_articles', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('author_id');
      $table->string('title')->nullable();
      $table->string('title_slug');
      $table->text('text')->nullable();
      $table->text('keywords')->nullable();
      $table->string('excerpt')->nullable();
      $table->string('thumbnail')->nullable();
      $table->string('reading_time', 100)->nullable();
      $table->integer('total_views')->default(0);
      $table->boolean('is_draft')->default(0);
      $table->boolean('is_active')->default(1);
      $table->boolean('is_listed')->default(1);
      $table->timestamp('published_at')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tm_articles');
  }
};
