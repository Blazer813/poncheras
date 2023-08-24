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
        Schema::create('estados', function (Blueprint $table) {
            $table->integer('idestado')->autoIncrement()->comment('Llave Primaria');
            $table->text('nomestado')->comment('Nombre del Estado');
            $table->text('color_fondo')->comment('Color del Fondo');
            $table->text('color_letras')->comment('Color de la letra');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados');
    }
};
