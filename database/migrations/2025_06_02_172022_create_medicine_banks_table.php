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
        Schema::create('medicine_banks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('manufacturer')->nullable();
            $table->text('generic')->nullable();
            $table->text('strength')->nullable();
            $table->string('type')->nullable();
            $table->string('use_for')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicine_banks');
    }
};
