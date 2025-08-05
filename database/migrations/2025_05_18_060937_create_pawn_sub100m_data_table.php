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
        Schema::create('pawn_sub100m_data', function (Blueprint $table) {
            $table->id();
            $table->integer('pawn_sub100m_id')->unsigned()->comment('id_auto');
            $table->string('pawn_barcode')->comment('Prawn_Barcode');
            $table->string('stock_category_id')->comment('Stock_Category_ID');
            $table->float('unit_bath')->default(0)->comment('UnitBath');
            $table->float('unit_salung')->default(0)->comment('UnitSalueng');
            $table->float('quantity')->default(0)->comment('Qty');
            $table->binary('is_erased')->nullable()->default(0)->comment('Is_Erased');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pawn_sub100m_data');
    }
};
