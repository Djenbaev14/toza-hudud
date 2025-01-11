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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('districts')->insert([
            'name'=>'Амударьинский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Берунийский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Город Нукус'
        ]);
        DB::table('districts')->insert([
            'name'=>'Канлыкульский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Караузякский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Кегейлийский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Кунградский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Муйнакский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Нукусский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Тахиаташский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Тахтакупырский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Ходжейлийский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Чимбайский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Шуманайский район'
        ]);
        DB::table('districts')->insert([
            'name'=>'Элликкалинский район'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
