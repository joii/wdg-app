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
        Schema::create('pawn_main_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('token_id')->nullable();
            $table->dateTime('d_date')->nullable()->comment('D_Date');
            $table->dateTime('d_time')->nullable()->comment('D_Time');
            $table->integer('type_transaction')->nullable()->comment('Type_Transaction');
            $table->string('barcode')->nullable()->comment('Barcode');
            $table->string('user_name')->nullable()->comment('User_name');
            $table->string('unit')->nullable()->comment('Unit');
            $table->boolean('is_t')->nullable()->comment('Is_T');
            $table->boolean('is_nt')->nullable()->comment('Is_NT');
            $table->boolean('is_mo')->nullable()->comment('Is_MO');
            $table->boolean('is_credit_gold_or_money')->nullable()->comment('Is_Credit_Gold_OR_Mone');
            $table->float('profit')->nullable()->comment('Profit');
            $table->float('up_down')->nullable()->comment('Up_Down');
            $table->float('discount')->nullable()->comment('Discount');
            $table->float('gold_price_government')->nullable()->comment('GoldPrice_Government');
            $table->float('gold_price_lagas')->nullable()->comment('GoldPrice_Lagas');
            $table->string('pim_card_or_card_no')->nullable()->comment('PimCard_OR_Card_No');
            $table->string('approve_by')->nullable()->comment('ApproveBy');
            $table->float('interest')->nullable()->comment('Interest');
            $table->float('amount')->nullable()->comment('Amount');
            $table->float('total')->nullable()->comment('Total');
            $table->float('cash')->nullable()->comment('Cash');
            $table->bigInteger('credit_debit_id')->nullable()->comment('Credit_Debit_ID');
            $table->boolean('is_erased')->nullable()->comment('Is_Erased');
            $table->dateTime('d_date_erased')->nullable()->comment('D_Date_Erased');
            $table->string('reason')->nullable()->comment('Reason');
            $table->bigInteger('credit_money_id')->nullable()->comment('Credit_Money_ID');
            $table->float('money_receive')->nullable()->comment('money_receive');
            $table->float('money_exchange')->nullable()->comment('money_exchange');
            $table->string('show_exchange')->nullable()->comment('show_exchang');
            $table->text('detail_receive')->nullable()->comment('detail_receive');
            $table->boolean('is_one')->nullable()->comment('Is_One');
            $table->bigInteger('id_running_exchange')->nullable()->comment('Id_Running_Exchange');
            $table->bigInteger('image_id')->nullable()->comment('ImageId');
            $table->bigInteger('customer_image_id')->nullable()->comment('CustomerImageId');
            $table->string('update_user')->nullable()->comment('UpdateUser');
            $table->dateTime('update_time')->nullable()->comment('UpdateTime');
            $table->boolean('is_j')->nullable()->comment('IS_J');
            $table->float('metal_price_lagas')->nullable()->comment('MetalPrice_Lagas');
            $table->float('gem_price_lagas')->nullable()->comment('GemPrice_Lagas');
            $table->float('diamond_price_lagas')->nullable()->comment('DiamondPrice_Lagas');
            $table->float('labour_cost_lagas')->nullable()->comment('LabourCost_Lagas');
            $table->boolean('is_a')->nullable()->comment('IS_A');
            $table->string('product_a_id')->nullable()->comment('ProductA_ID');
            $table->float('weight')->nullable()->comment('Weight');
            $table->float('gold_price')->nullable()->comment('GoldPrice');
            $table->float('kumnet_price')->nullable()->comment('KumnetPrice');
            $table->float('total_price')->nullable()->comment('TotalPrice');
            $table->bigInteger('credit_debit_id2')->nullable()->comment('Credit_Debit_ID2');
            $table->bigInteger('credit_debit_id3')->nullable()->comment('Credit_Debit_ID3');
            $table->bigInteger('credit_debit_id4')->nullable()->comment('Credit_Debit_ID4');
            $table->bigInteger('credit_debit_id5')->nullable()->comment('Credit_Debit_ID5');
            $table->bigInteger('credit_debit_id6')->nullable()->comment('Credit_Debit_ID6');
            $table->bigInteger('credit_debit_id7')->nullable()->comment('Credit_Debit_ID7');
            $table->bigInteger('credit_debit_id8')->nullable()->comment('Credit_Debit_ID8');
            $table->bigInteger('credit_debit_id9')->nullable()->comment('Credit_Debit_ID9');
            $table->bigInteger('credit_debit_id10')->nullable()->comment('Credit_Debit_ID10');
            $table->float('tax')->nullable()->comment('Tax');
            $table->integer('tax_type')->nullable()->comment('Tax_Type');
            $table->string('invoice_number')->nullable()->comment('Invoice_Number');
            $table->string('customer_name')->nullable()->comment('CustName');
            $table->string('customer_address')->nullable()->comment('Address');
            $table->string('customer_phone')->nullable()->comment('CustTel');
            $table->string('tax_id')->nullable()->comment('TaxID');
            $table->boolean('is_nj')->nullable()->comment('Is_NJ');
            $table->string('receipt_no')->nullable()->comment('Receipt_No');
            $table->dateTime('ship_date')->nullable()->comment('Ship_Date');
            $table->string('order_no')->nullable()->comment('Order_No');
            $table->string('ship_detail')->nullable()->comment('Ship_Detai');
            $table->string('payment')->nullable()->comment('Payment');
            $table->boolean('is_diff')->nullable()->comment('Is_Diff');
            $table->boolean('is_dis')->nullable()->comment('Is_Dis');
            $table->boolean('is_cre')->nullable()->comment('Is_Cre');
            $table->tinyText('remark')->nullable()->comment('Remark');
            $table->string('pos')->nullable()->comment('POS');
            $table->string('is_popup')->nullable()->comment('IS_Popup');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_main_transactions');
    }
};
