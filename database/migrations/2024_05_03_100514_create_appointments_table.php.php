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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            //foreign key from user table id
            $table->foreignId('userId')->constrained(
                table: 'users',
                indexName: 'appointments_user_id'
            )->onUpdate('cascade')->onDelete('cascade');
            //foreign key from chambers table id
            $table->string('merchantTransactionId');
            $table->integer('chamberId')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('whatsappNumber')->nullable();
            $table->enum('gender', ['m', 'f', 'o']);
            $table->date('dateOfBirth');
            $table->string('placeOfBirth');
            $table->string('stateOfBirth');
            $table->time('timeOfBirth');
            $table->date('bookingDate');
            $table->enum('appointmentType', ['o', 'm']);
            $table->enum('payment_status', ['n', 'p', 'c'])->default('n');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
