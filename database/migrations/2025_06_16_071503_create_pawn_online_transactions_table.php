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
        Schema::create('pawn_online_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('token_id')->nullable();
            $table->dateTime('transaction_date')->nullable()->comment('D_Date');
            $table->dateTime('transaction_time')->nullable()->comment('D_Time');
            $table->string('transaction_code')->nullable();
            $table->integer('transaction_type')->nullable()->comment('Type_Transaction');
            $table->string('pawn_barcode')->nullable()->comment('Barcode');
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->string('interest')->nullable()->comment('imterest');
            $table->decimal('amount', 12, 2)->nullable()->comment('amount');
            $table->string('payment_method')->nullable()->comment('payment');
            $table->dateTime('payment_date')->nullable();
            $table->string('payment_slip')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('customer_name')->nullable()->comment('CustName');
            $table->string('customer_address')->nullable()->comment('CustName');
            $table->string('customer_phone')->nullable()->comment('CustTel');
            $table->text('remarks')->nullable()->comment('Remark');
            $table->string('approved_by')->nullable()->comment('ApproveBy');
            $table->string('is_erased')->nullable()->comment('Is_Erased');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_online_transactions');
    }
};
