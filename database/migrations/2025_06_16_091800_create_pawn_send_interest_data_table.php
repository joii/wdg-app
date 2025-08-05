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
        Schema::create('pawn_send_interest_data', function (Blueprint $table) {
            $table->id();
            $table->string('id_card')->nullable()->comment('ID_Card');
            $table->bigInteger('pawn_id')->nullable()->comment('Prawn_ID');
            $table->string('pawn_barcode')->nullable()->comment('Prawn_Barcode');
            $table->dateTime('pawn_expire_date')->nullable()->comment('Prawn_Expire_Date');
            $table->float('interest')->nullable()->comment('Interest');
            $table->integer('period')->nullable()->comment('Period');
            $table->dateTime('pawn_cal_interest_date')->nullable()->comment('Prawn_Date_Cal_Interest');
            $table->float('total_pawn_amount')->nullable()->comment('Total_PrawnAmount');
            $table->float('pawn_card_no')->nullable()->comment('PrawnCard_No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_send_interest_data');
    }
};
