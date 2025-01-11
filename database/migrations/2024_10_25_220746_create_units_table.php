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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('units')->insert([
            'name'=>'грамм'
        ]);
        DB::table('units')->insert([
            'name'=>'кв м'
        ]);
        DB::table('units')->insert([
            'name'=>'кг'
        ]);
        DB::table('units')->insert([
            'name'=>'литр'
        ]);
        DB::table('units')->insert([
            'name'=>'метр'
        ]);
        DB::table('units')->insert([
            'name'=>'штук'
        ]);
        DB::table('units')->insert([
            'name'=>'пачка'
        ]);
        
        DB::table('units')->insert([
            'name'=>'Кубметр'
        ]);
        DB::table('units')->insert([
            'name'=>'Тонна'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
