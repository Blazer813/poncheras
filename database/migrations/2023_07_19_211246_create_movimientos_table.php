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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->integer('idmovimiento')->autoIncrement()->comment('Llave Primaria');
            $table->date('fcmovimiento')->comment('Fecha del Movimiento');
            $table->text('descripcion')->comment('Descripcion del Movimiento');
            $table->text('evidencia')->comment('Evidencia');
            $table->integer('valordeuda')->comment('Valor de la Deuda');
            $table->integer('valorabono')->comment('Valor del Abono');
            $table->date('fcpago')->comment('Fecha del Pago');
            $table->text('detanulacion')->comment('Detalle de la Anulacion');
            $table->date('fcanulacion')->comment('Fecha de la anulacion');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
