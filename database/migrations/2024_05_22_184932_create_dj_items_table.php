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
            $table->unsignedBigInteger('dj_id');
            $table->float('m3');
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
        Schema::dropIfExists('dj_items');
    }
};
