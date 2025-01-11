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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->longText('description');
            $table->string('format');
            $table->timestamps();
        });

        $attributes=[
            [
                'name'=>'Басып отилген жолы',
                'format'=>'number'
            ],
            [
                'name'=>'Аддресс',
                'format'=>'string'
            ],
            [
                'name'=>'Канша Литр кеткени',
                'format'=>'number'
            ],
            [
                'name'=>'Хазирги км корсеткиши',
                'format'=>'number'
            ]
        ];
        foreach ($attributes as $attribute) {
            DB::table('attributes')->insert([
                'name'=>$attribute['name'],
                'format'=>$attribute['format'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
