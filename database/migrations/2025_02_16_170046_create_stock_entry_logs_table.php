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
        Schema::create('stock_entry_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('medecine_id');
            $table->integer('mrr_id')->nullable()->default(0);
            $table->decimal('stock_qty',18,2)->nullable();
            $table->date('stock_date');
            $table->date('manufacture_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_entry_logs');
    }
};
