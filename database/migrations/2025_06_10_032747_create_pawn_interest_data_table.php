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
        Schema::create('pawn_interest_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable()->comment('CustID');
            $table->bigInteger('pawn_id')->unsigned()->nullable()->comment('PrawnID');
            $table->string('pawn_barcode')->nullable()->comment('Prawn_Barcode');
            $table->string('pawn_card_no')->nullable()->comment('PrawnCard_No');
            $table->dateTime('pawn_expire_date')->nullable()->comment('Prawn_Expire_Date');
            $table->integer('number_of_month')->unsigned()->nullable()->comment('Month_How');
            $table->float('interest')->unsigned()->nullable()->comment('Interest');
            $table->integer('period')->unsigned()->nullable()->comment('Period');
            $table->dateTime('pawn_cal_interest_date')->nullable()->comment('Prawn_Date_Cal_Interest');
            $table->float('total_pawn_amount')->unsigned()->nullable()->comment('Total_PrawnAmount');
            $table->float('interest_rate')->unsigned()->nullable()->comment('Percent_Interest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_interest_data');
    }
};
