<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banner_videos', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->string('videolink')->nullable();
            $table->text('bannertext')->nullable();
            $table->enum('thumbnailtype', ['0', '1'])->comment('0 = banner, 1 = video');
            $table->enum('show', ['0', '1'])->comment('0=hide, 1=show');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_videos');
    }
};
