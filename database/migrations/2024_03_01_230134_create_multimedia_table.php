<?php

use App\Enums\MultimediaType;
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
        Schema::create('multimedia', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('path');
            $table->string('text_alternative')->nullable();
            $table->enum('mimetype',
                array_map(fn (MultimediaType $multimediaType) => $multimediaType->value, MultimediaType::cases()));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multimedia');
    }
};
