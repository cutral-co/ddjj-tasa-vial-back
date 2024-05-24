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
            $table->string('razon_social');
            $table->string('periodo');
            $table->float('total_precio', 10)->default(0);
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
