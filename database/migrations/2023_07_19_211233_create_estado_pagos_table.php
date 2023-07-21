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
        Schema::create('estado_pagos', function (Blueprint $table) {
            $table->integer('idestadopago')->autoIncrement()->comment('Llave Primaria');
            $table->text('nomestado')->comment('Nombre del Estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estado_pagos');
    }
};
