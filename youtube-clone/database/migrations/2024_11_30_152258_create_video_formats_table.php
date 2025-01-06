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
        Schema::create('video_formats', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID for video_formats table
            $table->string('quality');
            $table->string('file_path');
            $table->foreignId('video_id')->constrained('videos')->cascadeOnDelete(); // Foreign key referencing video.id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_formats');
    }
};
