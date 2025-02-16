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
        Schema::create('medecines', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer')->nullable();
            $table->string('name')->nullable();
            $table->text('generic')->nullable();
            $table->text('strength')->nullable();
            $table->text('type')->nullable();
            $table->string('use_for')->nullable();
            $table->string('category',3)->nullable();
            $table->integer('stock_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecines');
    }
};
