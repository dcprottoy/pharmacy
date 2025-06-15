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
        Schema::create('mrrs', function (Blueprint $table) {
            $table->id();
            $table->integer('mrr_id');
            $table->integer('supplier_id');
            $table->string('supplier_name');
            $table->string('challan_no');
            $table->date('purchase_date');
            $table->decimal('bill_amount',18,2)->default(0);
            $table->decimal('paid_amount',18,2)->default(0);
            $table->decimal('due_amount',18,2)->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->boolean('approved')->nullable()->default(false);
            $table->boolean('paid_status')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mrrs');
    }
};
