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
        Schema::create('pawn_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pawn_id')->comment('Prawn_ID');
            $table->unsignedBigInteger('transaction_id')->comment('Transaction_ID');
            $table->string('transaction_type')->nullable()->default(NULL);
            $table->unsignedBigInteger('pawn_add_id')->nullable()->default(NULL)->comment('PrawnAdd_ID');
            $table->unsignedBigInteger('pawn_interest_id')->nullable()->default(NULL)->comment('PrawnInterest_ID');
            $table->unsignedBigInteger('pawn_accrued_interest_id')->nullable()->default(NULL)->comment('PrawnSendInterest_ID');
            $table->unsignedBigInteger('yup_id')->nullable()->default(NULL)->comment('Yup_ID');
            $table->unsignedBigInteger('withdrawn_id')->nullable()->default(NULL)->comment('Withdrawn_ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_transactions');
    }
};
