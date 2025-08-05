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
        Schema::create('pawns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pawn_id')->nullable()->comment('Prawn_ID');
            $table->dateTime('pawn_date')->nullable()->comment('Prawn_Date');
            $table->dateTime('pawn_time')->nullable()->comment('Prawn_Time');
            $table->string('pawn_barcode')->nullable()->comment('Prawn_Barcode');
            $table->string('pawn_card_no')->nullable()->comment('PrawnCard_No');
            $table->float('period')->nullable()->comment('Period');
            $table->bigInteger('percent_interest')->nullable()->comment('Percent_Interest');
            $table->string('type_full')->nullable()->comment('TypeFull');
            $table->float('unit_baht_grand_total')->nullable()->comment('UnitBathGrandTotal');
            $table->float('unit_quarter_grand_total')->nullable()->comment('UnitSaluengGrandTotal');
            $table->float('total_weight')->nullable()->comment('Total_Weight');
            $table->float('total_pawn_amount')->nullable()->comment('Total_PrawnAmount');
            $table->string('user_name')->nullable()->comment('User_name');
            $table->float('weight_100m_total')->nullable()->default(0)->comment('Weight100MTotal');
            $table->float('price_100m_total')->nullable()->default(0)->comment('Price100MTotal');
            $table->float('weight_100nm_total')->nullable()->default(0)->comment('Weight100NMTotal');
            $table->float('price_100nm_total')->nullable()->default(0)->comment('Price100NMTotal');
            $table->float('weight_nm_total')->nullable()->default(0)->comment('WeightNMTotal');
            $table->float('price_nm_total')->nullable()->default(0)->comment('PriceNMTotal');
            $table->dateTime('pawn_date_cal_interest')->nullable()->comment('Prawn_Date_Cal_Interest');
            $table->boolean('is_erased')->default(0)->comment('Is_Erased');
            $table->boolean('is_withdrawn')->default(0)->comment('Is_Withdrawn');
            $table->boolean('is_yup')->default(0)->comment('Is_Yup');
            $table->bigInteger('customer_id')->nullable()->comment('Column added by Online');
            $table->string('customer_name')->nullable()->comment('Name_Cust');
            $table->string('customer_address')->nullable()->comment('Addr_Cust');
            $table->string('customer_phone')->nullable()->comment('Tel_Cust');
            $table->string('comment')->nullable()->comment('Comment');
            $table->dateTime('date_erased')->nullable()->comment('Date_Erased');
            $table->tinyText('remarks')->nullable()->comment('Remarks');
            $table->float('total_pawn_amount_first')->nullable()->comment('Total_PrawnAmount_First');
            $table->boolean('is_chk')->nullable()->default(0)->comment('Is_Chk');
            $table->string('p_no')->nullable()->comment('P_No');
            $table->string('id_card')->nullable()->comment('ID_Card');
            $table->integer('emp_id')->nullable()->comment('EmpID');
            $table->boolean('use_fp')->nullable()->default(0)->comment('use_fp');
            $table->boolean('is_withdrawn_fp')->nullable()->default(0)->comment('Is_Withdrawn_fp');
            $table->boolean('is_log')->nullable()->default(0)->comment('Is_log');
            $table->string('sn')->nullable()->comment('SN');
            $table->tinyText('warning_msg')->nullable()->comment('WarningMsg');
            $table->boolean('is_vip')->nullable()->default(0)->comment('Is_VIP');
            $table->float('est_price_100m_total')->nullable()->comment('estPrice100MTotal');
            $table->float('est_price_100nm_total')->nullable()->comment('estPrice100NMTotal');
            $table->string('remark_overdue')->nullable()->comment('Remarkoverdue');
            $table->bigInteger('emp_face_id')->nullable()->comment('EmpFaceId');
            $table->boolean('is_withdrawn_face')->nullable()->default(0)->comment('Is_Withdrawn_face');
            $table->integer('is_config36')->nullable()->default(0)->comment('Is_Config36');
            $table->integer('is_pending_yup')->nullable()->default(0)->comment('Is_PendingYup');
            $table->bigInteger('is_shift_yup')->nullable()->default(0)->comment('Is_ShiftYup');
            $table->dateTime('shift_yup_date')->nullable()->comment('ShiftYup_Date');
            $table->tinyText('shift_yup_desc')->nullable()->comment('ShiftYup_Desc');
            $table->dateTime('expire_date')->nullable()->comment('Expire_Date');
            $table->tinyText('remark_admin')->nullable()->comment('Remark_Admin');
            $table->boolean('is_unlock')->nullable()->default(0)->comment('Is_UnLock');
            $table->tinyText('user_name_erased')->nullable()->comment('User_Name_Erased');
            $table->dateTime('lottery_date')->nullable()->comment('Lottery_Date');
            $table->string('lottery_1')->nullable()->comment('Lottery_1');
            $table->string('lottery_2')->nullable()->comment('Lottery_2');
            $table->string('lottery_3')->nullable()->comment('Lottery_3');
            $table->string('lottery_4')->nullable()->comment('Lottery_4');
            $table->boolean('lottery_winning')->nullable()->default(0)->comment('Lottery_Winning');
            $table->boolean('lottery_expire')->nullable()->default(0)->comment('Lottery_Expire');
            $table->boolean('lottery_reward')->nullable()->default(0)->comment('Lottery_Reward');
            $table->string('lottery_barcode')->nullable()->comment('Lottery_Barcode');
            $table->string('pawn_online')->nullable()->comment('PrawnOnline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawns');
    }
};
