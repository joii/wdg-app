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
        Schema::create('pawn_subnm_data', function (Blueprint $table) {
            $table->id();
            $table->integer('pawn_subnm_id')->unsigned()->comment('id_auto');
            $table->string('pawn_barcode')->comment('Prawn_Barcode');
            $table->string('stock_category_id')->comment('Stock_Category_ID');
            $table->float('weight_gram')->default(0)->comment('Weight_Gram');
            $table->float('quantity')->default(0)->comment('Qty');
            $table->float('price')->default(0)->comment('Price');
            $table->binary('is_erased')->nullable()->default(0)->comment('Is_Erased');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_subnm_data');
    }
};
