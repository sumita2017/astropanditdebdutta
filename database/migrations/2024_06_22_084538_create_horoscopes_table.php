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
        Schema::create('horoscopes', function (Blueprint $table) {
            $table->id();
            $table->enum('horoscopetype', ['D', 'W', 'M', 'Y'])->comment('D = DAY, W = week, M=month, Y = year');
            $table->string('filename');
            $table->enum('show', ['0', '1'])->comment('0=hide, 1=show');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horoscopes');
    }
};
