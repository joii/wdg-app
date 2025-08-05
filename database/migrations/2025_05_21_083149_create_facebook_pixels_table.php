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
        Schema::create('facebook_pixels', function (Blueprint $table) {
            $table->id();
            $table->string('pixel_name');
            $table->string('pixel_id');
            $table->string('domain_scope');
            $table->string('event_script');
            $table->string('note');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facebook_pixels');
    }
};
