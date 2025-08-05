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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable()->comment('id_auto');
            $table->string('name')->nullable()->comment('name');
            $table->string('address')->nullable()->comment('address');
            $table->string('tel')->nullable()->comment('tel');
            $table->boolean('is_date')->nullable()->default(0)->comment('Is_Date');
            $table->dateTime('date_of_birth')->nullable()->comment('D_Birth');
            $table->string('comment')->nullable()->comment('comment');
            $table->string('id_card')->nullable()->comment('ID_Card');
            $table->integer('emp_id')->nullable()->comment('EmpId');
            $table->boolean('is_delete')->nullable()->default(0)->comment('IsDelete');
            $table->integer('member_id')->nullable()->comment('MemberId');
            $table->bigInteger('emp_face_id')->nullable()->comment('EmpFaceId');
            $table->bigInteger('customer_image_id')->nullable()->comment('CustomerImageId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
