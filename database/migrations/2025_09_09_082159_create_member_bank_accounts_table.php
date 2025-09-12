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
        Schema::create('member_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id');
            $table->string('bank_account_number', 30);
            $table->string('bank_name', 100)->nullable();
            $table->string('account_holder_name', 100)->nullable();
            $table->string('book_bank', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_bank_accounts');
    }
};
