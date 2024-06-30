<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\{Schema, DB};

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('derivados', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('derivados')->insert([
            ['name' => 'Gas Oil Grado 2'],
            ['name' => 'Gas Oil Grado 3'],
            ['name' => 'GLPA'],
            ['name' => 'GNC'],
            ['name' => 'Nafat (común) hasta 92 Ron'],
            ['name' => 'Nafat (premium) de más de 95 Ron'],
            ['name' => 'Nafat (súper) entre 92 y 95 Ron'],
            ['name' => 'Kerosene'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('derivados');
    }
};
