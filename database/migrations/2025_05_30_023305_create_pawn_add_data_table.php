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
        Schema::create('pawn_add_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_card')->nullable()->comment('ID_Card');
            $table->integer('pawn_id')->nullable()->comment('PrawnAdd_ID');
            $table->string('pawn_barcode')->nullable()->comment('Prawn_Barcode');
            $table->dateTime('pawn_expire_date')->comment('Prawn_Expire_Date');
            $table->float('pawn_add')->nullable()->comment('PrawnAdd');
            $table->integer('period')->nullable()->comment('Period');
            $table->dateTime('pawn_date_cal_interest')->nullable()->comment('Prawn_Date_Cal_Interest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_add_data');
    }
};
