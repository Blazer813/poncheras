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
        Schema::create('tipos_poncheras', function (Blueprint $table) {
            $table->integer('idponches')->autoIncrement()->comment('Llave primaria');
            $table->string('nombreponche')->comment('Nombre Ponchera');
            $table->integer('valor')->comment('Valor Ponchera');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_poncheras');
    }
};
