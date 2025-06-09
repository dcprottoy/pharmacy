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
        Schema::create('products', function (Blueprint $table) {
            //Table Information
            $table->id();
            //All Product Information
            $table->string('name')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_category')->nullable();
            $table->string('product_sub_category')->nullable();
            //Only Medicine Product Information
            $table->text('generic')->nullable();
            $table->text('strength')->nullable();
            $table->string('use_for')->nullable();  
            //Stock Related Information
            $table->decimal('last_stock',18,2)->nullable()->default(0);
            $table->decimal('current_stock',18,2)->nullable()->default(0);
            $table->decimal('mrp_rate',18,2)->nullable()->default(0);
            $table->decimal('tp_rate',18,2)->nullable()->default(0);
            $table->string('stock_location')->nullable();
            $table->string('stock_per')->nullable();
            //Total History Informatin
            $table->decimal('total_stock',18,2)->nullable()->default(0);
            $table->decimal('total_sale',18,2)->nullable()->default(0);

            $table->integer('manufacturer_id')->default(0);
            $table->integer('product_type_id')->default(0);
            $table->integer('product_category_id')->default(0);
            $table->integer('product_sub_category_id')->default(0);
            $table->integer('medicine_use_for_id')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
