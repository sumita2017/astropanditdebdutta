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
        Schema::create('phonepes', function (Blueprint $table) {
            $table->id();
            $table->integer('paymentamount');
            $table->string('hosturl');
            $table->string('marchecntkey');
            $table->string('apikey');
            $table->string('apiindex');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phonepes');
    }
};
