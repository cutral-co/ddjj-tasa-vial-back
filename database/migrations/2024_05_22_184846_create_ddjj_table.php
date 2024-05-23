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
        Schema::create('ddjj', function (Blueprint $table) {
            $table->id();
            $table->string('periodo', 6);
            $table->string('razon_social');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            /* Relaciones */
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ddjj');
    }
};
