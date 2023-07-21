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
        Schema::table('movimientos', function (Blueprint $table){
            $table->integer('idcolaborador')->after('fcmovimiento')->comment('Llave Foranea de Colaborador');
            $table->foreign('idcolaborador')->references('idcolaborador')->on('colaboradors');

            $table->integer('idponches')->after('evidencia')->comment('Llave Foranea de Poncheras');
            $table->foreign('idponches')->references('idponches')->on('tipos_poncheras');

            $table->integer('idestado')->after('fcpago')->comment('Llave Foranea de Estado');
            $table->foreign('idestado')->references('idestado')->on('estados');

            $table->integer('idestadopago')->after('valorabono')->comment('Llave Forane de Estado de Pago');
            $table->foreign('idestadopago')->references('idestadopago')->on('estado_pagos');

            $table->integer('iduser')->after('idcolaborador')->comment('Llave Foranea del Causante');
            $table->foreign('iduser')->references('iduser')->on('users');
        });

        Schema::table('users', function (Blueprint $table){
            $table->integer('idcolaborador')->nullable()->after('iduser')->comment('Llave Foranea de Colaborador');
            $table->foreign('idcolaborador')->references('idcolaborador')->on('colaboradors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foraneas');
    }
};
