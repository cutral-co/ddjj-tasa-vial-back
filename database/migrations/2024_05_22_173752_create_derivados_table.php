<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('coeficiente');
            $table->timestamps();
        });

        DB::table('derivados')->insert([
            ['name' => 'Gas Oil Grado 2', 'coeficiente' => 1000],
            ['name' => 'Gas Oil Grado 3', 'coeficiente' => 1000],
            ['name' => 'GLPA', 'coeficiente' => 1000],
            ['name' => 'GNC', 'coeficiente' => 1],
            ['name' => 'Nafta (común) hasta 92 Ron', 'coeficiente' => 1000],
            ['name' => 'Nafta (premium) de más de 95 Ron', 'coeficiente' => 1000],
            ['name' => 'Nafta (súper) entre 92 y 95 Ron', 'coeficiente' => 1000],
            ['name' => 'Kerosene', 'coeficiente' => 1000],
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
