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
        Schema::create('colaboradors', function (Blueprint $table) {
            $table->integer('idcolaborador')->autoIncrement()->comment('Llave primaria');
            $table->string('nombrecompleto', 50)->comment('Nombre Completo');
            $table->bigInteger('documentoid')->comment('Documento de Identificacicón');
            $table->bigInteger('telefono')->comment('Numero Telefono');
            $table->string('correo', 50)->comment('Correo Electronico');
            $table->date('fcnacimiento')->comment('Fecha de nacimiento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colaboradors');
    }
};
