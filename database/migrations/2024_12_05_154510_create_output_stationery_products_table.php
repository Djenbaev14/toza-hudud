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
        Schema::create('output_stationery_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('output_stationery_id')->constrained()->onDelete('cascade');
            $table->foreignId('stationery_id')->constrained()->onDelete('cascade');
            $table->bigInteger('quantity');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('output_stationery_products');
    }
};
