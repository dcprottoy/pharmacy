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
        Schema::create('medecine_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer')->nullable();
            $table->string('name')->nullable();
            $table->text('generic')->nullable();
            $table->text('strength')->nullable();
            $table->text('type')->nullable();
            $table->string('use_for')->nullable();
            $table->string('category',3)->nullable();
            $table->integer('medecine_id')->nullable();
            $table->decimal('last_stock',18,2)->nullable()->default(0);
            $table->decimal('current_stock',18,2)->nullable()->default(0);
            $table->decimal('mrp_rate',18,2)->nullable()->default(0);
            $table->decimal('tp_rate',18,2)->nullable()->default(0);
            $table->decimal('stock_cell',18,2)->nullable()->default(0);
            $table->string('stock_per')->nullable();
            $table->date('stock_date')->nullable();
            $table->decimal('total_stock',18,2)->nullable()->default(0);
            $table->decimal('total_sale',18,2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecine_stocks');
    }
};
