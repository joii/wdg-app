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
        Schema::create('pawn_add_transactions', function (Blueprint $table) {
            $table->id()->comment('PrawnAdd_ID');
            $table->string('token_id')->nullable();
            $table->dateTime('pawn_add_date')->nullable()->comment('PrawnAdd_Date');
            $table->dateTime('pawn_add_time')->nullable()->comment('PrawnAdd_Time');
            $table->string('pawn_barcode')->nullable()->comment('Prawn_Barcode');
            $table->float('total_prawn_amount')->nullable()->comment('Total_PrawnAmount');
            $table->float('add_amount')->nullable()->comment('AddAmount');
            $table->float('new_total_pawn_amount')->nullable()->comment('New_Total_PrawnAmount');
            $table->boolean('is_erased')->nullable()->comment('Is_Erased');
            $table->string('choose_gold')->nullable()->comment('Choose_Gold');
            $table->dateTime('date_erased')->nullable()->comment('PrawnAdd_Date');
            $table->boolean('is_chk')->nullable()->comment('Is_Chk');
            $table->boolean('use_fp')->nullable()->comment('use_fp');
            $table->boolean('is_no_card')->nullable()->comment('Is_Nocard');
            $table->boolean('loss_card')->nullable()->comment('losscard');
            $table->string('staff')->nullable()->comment('Staff');
            $table->string('user_name_erased')->nullable()->comment('User_Name_Erased');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_add_transactions');
    }
};
