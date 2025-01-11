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
        Schema::create('certificate_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('certificate_categories')->insert([
            'name'=>'A'
        ]);
        
        DB::table('certificate_categories')->insert([
            'name'=>'B'
        ]);
        DB::table('certificate_categories')->insert([
            'name'=>'C'
        ]);
        DB::table('certificate_categories')->insert([
            'name'=>'D'
        ]);
        DB::table('certificate_categories')->insert([
            'name'=>'BE'
        ]);
        DB::table('certificate_categories')->insert([
            'name'=>'CE'
        ]);
        DB::table('certificate_categories')->insert([
            'name'=>'DE'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_categories');
    }
};
