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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            //foreign key from appointments table id
            $table->foreignId('appointmentId')->constrained(
                table: 'appointments',
                indexName: 'invoices_appointments_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('invoiceId');
            $table->string('merchantTransactionId');
            $table->string('transactionId');
            $table->string('providerReferenceId');
            $table->string('amount');
            $table->string('status');
            $table->string('responseCode');
            $table->string('cardType')->nullable();
            $table->string('type')->nullable();
            $table->string('utr')->nullable();
            $table->string('arn')->nullable();
            $table->string('pgServiceTransactionId')->nullable();
            $table->string('pgTransactionId')->nullable();
            $table->string('bankTransactionId')->nullable();
            $table->string('pgAuthorizationCode')->nullable();
            $table->string('bankId')->nullable();
            $table->string('brn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
