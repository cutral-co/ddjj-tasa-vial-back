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
        Schema::create('coeficientes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->float('value', 8, 4);
            $table->timestamps();
        });

        DB::table('coeficientes')->insert([
            [
                'name' => 'percepcion',
                'value' => 0.045,
                'description' => 'Percepción'
            ],
            [
                'name' => 'recaudacion',
                'value' => 0.05,
                'description' => 'Recaudación'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coeficiente');
    }
};
