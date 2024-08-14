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
            $table->string('periodo');

            $table->double('total', 15)->default(0);
            $table->double('total_percibido', 15)->default(0);
            $table->double('gastos_adm', 15)->default(0);
            $table->double('total_pagar', 15)->default(0);

            $table->integer('rectificativa')->default(0);
            $table->timestamp('fecha_presentacion');

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
