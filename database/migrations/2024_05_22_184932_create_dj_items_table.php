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

            $table->double('precio', 15);
            $table->double('volumen_m3', 15);
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
