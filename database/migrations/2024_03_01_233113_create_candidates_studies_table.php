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
        Schema::create('candidates_studies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('multimedia_id')->nullable();
            $table->foreign('multimedia_id')->references('id')->on('multimedia')->cascadeOnDelete();
            $table->string('name');
            $table->string('description')->nullable();
            $table->dateTimeTz('start_date', precision: 0)->nullable();
            $table->dateTimeTz('finish_date', precision: 0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates_studies');
    }
};
