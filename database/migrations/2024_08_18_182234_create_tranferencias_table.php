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
        Schema::create('transferencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dj_id');
            $table->timestamp('fecha_pago');
            $table->double('monto', 15);
            $table->timestamps();
            /* Relaciones */
            $table->foreign('dj_id')->references('id')->on('ddjj');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transferencias');
    }
};
