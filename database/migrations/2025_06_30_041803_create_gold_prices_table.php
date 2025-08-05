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
        Schema::create('gold_prices', function (Blueprint $table) {
            $table->id();
             $table->date('date'); // วันที่ของราคา
            $table->time('time'); // เวลาของราคา
            $table->decimal('buy_gold_bar', 10, 2)->nullable(); // ราคารับซื้อทองคำแท่ง
            $table->decimal('sell_gold_bar', 10, 2)->nullable(); // ราคาขายออกทองคำแท่ง
            $table->decimal('buy_gold', 10, 2)->nullable(); // ราคารับซื้อทองรูปพรรณ
            $table->decimal('sell_gold', 10, 2)->nullable(); // ราคาขายออกทองรูปพรรณ
            $table->string('change_compare_previous')->nullable();
            $table->string('change_compare_yesterday')->nullable();
            $table->timestamps();

            // เพิ่ม index เพื่อประสิทธิภาพในการค้นหาตามวันที่และเวลา
            $table->index(['date', 'time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gold_prices');

    }
};
