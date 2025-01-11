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
        Schema::create('garage_expenditure_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');
            $table->foreignId('garage_id')->constrained()->onDelete('cascade');
            $table->foreignId('expenditure_type_id')->constrained()->onDelete('cascade');
            $table->foreignId('expenditure_id')->constrained()->onDelete('cascade');
            $table->string('size');
            $table->string('km');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garage_expenditure_types');
    }
};
