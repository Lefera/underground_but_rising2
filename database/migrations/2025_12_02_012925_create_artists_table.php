<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('city')->nullable();
            $table->foreignId('genre_id')
                  ->nullable()
                  ->constrained('genres')
                  ->nullOnDelete();

            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
