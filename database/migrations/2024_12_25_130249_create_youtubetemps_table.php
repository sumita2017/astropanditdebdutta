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
        Schema::create('youtubetemps', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longText('url_to_page');
            $table->longText('url_to_image');
            $table->integer('description');
            $table->string('updatetime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youtubetemps');
    }
};
