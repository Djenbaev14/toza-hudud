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
        Schema::create('expenditure_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units');
            $table->string('name')->unique();
            $table->boolean('standard_type')->default(0);
            $table->timestamps();
        });

        DB::table('expenditure_types')->insert([
            'unit_id'=>'4',
            'name'=>'Бензин',
            'standard_type'=>1
        ]);
        
        DB::table('expenditure_types')->insert([
            'unit_id'=>'2',
            'name'=>'Метан',
            'standard_type'=>1
        ]);
        
        DB::table('expenditure_types')->insert([
            'unit_id'=>'4',
            'name'=>'Солярки',
            'standard_type'=>1
        ]);


        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenditure_types');
    }
};
