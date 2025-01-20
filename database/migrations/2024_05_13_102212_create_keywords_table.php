<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->enum('language', ['English', 'Bengali', 'Hindi'])->default("English");
            $table->timestamps();
        });

        DB::table('keywords')
            ->insert(array(
                array('keyword' => "astrology"),
            ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keywords');
    }
};
