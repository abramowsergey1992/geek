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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id') ->constrained()
      ->onUpdate('cascade')
      ->onDelete('cascade');
            $table->char('title');
            $table->string('photo');
            $table->text('description');
            $table->text('content'); 
            $table->dateTime('delay');
            $table->boolean('draft')->default('1')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};