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
        Schema::create('dj_items', function (Blueprint $table) {
            $table->id();

            $table->float('precio', 10);
            $table->float('precio_final', 10);
            $table->float('volumen_m3', 10);
            $table->boolean('exento')->default(false);

            $table->unsignedBigInteger('dj_id');
            $table->unsignedBigInteger('derivado_id');
            $table->timestamps();

            /* Relaciones */
            $table->foreign('dj_id')->references('id')->on('ddjj');
            $table->foreign('derivado_id')->references('id')->on('derivados');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dj_items');
    }
};
