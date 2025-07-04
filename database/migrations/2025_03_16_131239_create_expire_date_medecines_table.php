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
        Schema::create('expire_date_medecines', function (Blueprint $table) {
            $table->id();
            $table->integer('medecine_id');
            $table->decimal('stock_qty',18,2)->default(0);
            $table->decimal('current_qty',18,2)->default(0);
            $table->decimal('sell_qty',18,2)->default(0);
            $table->date('expiry_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expire_date_medecines');
    }
};
