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
        Schema::create('pawn_accrued_interests', function (Blueprint $table) {
            $table->id()->comment('SendInterest_ID');
            $table->bigInteger('customer_id')->unsigned()->comment('Cust_ID');
            $table->dateTime('send_interest_date')->nullable()->comment('SendInterest_Date');
            $table->dateTime('send_interest_time')->nullable()->comment('SendInterest_Time');
            $table->string('pawn_barcode')->nullable()->comment('Prawn_Barcode');
            $table->string('pim_card_no')->nullable()->comment('PimCard_No');
            $table->string('pawn_card_no')->nullable()->comment('PrawnCard_No');
            $table->string('new_pawn_card_no')->nullable()->comment('New_PrawnCard_No');
            $table->integer('month_how')->nullable()->comment('Month_How');
            $table->integer('day_how')->nullable()->comment('Day_How');
            $table->float('send_pawn_balance')->default(0)->comment('SendPrawn_Balance');
            $table->float('withdrawn_partial_amount')->default(0)->comment('Withdrawn_PartialAmount');
            $table->float('weight')->nullable()->comment('Weight');
            $table->float('interest_before')->nullable()->comment('Interest_Before');
            $table->float('interset_after')->nullable()->comment('Interset_After');
            $table->boolean('is_erased')->nullable()->comment('Is_Erase');
            $table->dateTime('date_erased')->nullable()->comment('Date_Erase');
            $table->boolean('is_min')->nullable()->comment('Is_Min');
            $table->string('choose_gold')->nullable()->comment('Choose_Gold');
            $table->boolean('is_chk')->nullable()->comment('Is_Chk');
            $table->boolean('is_add')->nullable()->comment('Is_Add');
            $table->float('add_amount')->default(0)->comment('AddAmount');
            $table->boolean('use_fp')->nullable()->comment('use_fp');
            $table->integer('del_how')->nullable()->comment('Del_How');
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
        Schema::dropIfExists('pawn_accrued_interests');
    }
};
