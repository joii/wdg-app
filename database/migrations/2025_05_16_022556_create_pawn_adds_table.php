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
        Schema::create('pawn_adds', function (Blueprint $table) {
            $table->id()->comment('PrawnAdd_ID');
            $table->bigInteger('customer_id')->unsigned()->comment('Cust_ID');
            $table->dateTime('pawn_add_date')->nullable()->comment('PrawnAdd_Date');
            $table->dateTime('pawn_add_time')->nullable()->comment('PrawnAdd_Time');
            $table->string('pawn_barcode')->nullable()->comment('Prawn_Barcode');
            $table->float('total_prawn_amount')->default(0)->comment('Total_PrawnAmount');
            $table->float('add_amount')->default(0)->comment('AddAmount');
            $table->float('new_total_pawn_amount')->nullable()->comment('New_Total_PrawnAmount	');
            $table->string('choose_gold')->nullable()->comment('Choose_Gold');
            $table->boolean('is_erased')->nullable()->comment('Is_Erase');
            $table->dateTime('date_erased')->nullable()->comment('Date_Erase');
            $table->boolean('is_chk')->nullable()->comment('Is_Chk');
            $table->boolean('use_fp')->nullable()->comment('use_fp');
            $table->boolean('is_no_card')->nullable()->comment('Is_Nocard');
            $table->float('loss_card')->default(0)->comment('losscard');
            $table->string('staff')->nullable()->comment('Staff');
            $table->tinyText('user_name_erased')->nullable()->comment('User_Name_Erased');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_adds');
    }
};
