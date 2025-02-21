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
        Schema::create('shop_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('shop_id');
            $table->text('adress_line1');
            $table->text('adress_line2');
            $table->tinyInteger('owner_id')->nullable();
            $table->time('start_time')->default('00:00:00');
            $table->time('end_time')->default('00:00:00');
            $table->longText('banner_img')->nullable();
            $table->longText('logo_img')->nullable();
            $table->longText('shop_img')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('delete_flag')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_details');
    }
};
