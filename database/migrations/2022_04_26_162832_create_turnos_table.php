<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maniobras_id')->constrained('maniobras');
            $table->string('NombreTurno');
            $table->date('FechaInicio');
            $table->date('FechaFinal');
            $table->time('HoraInicio');
            $table->time('HoraFinal');
            $table->integer('NumeroManiobristas');
            $table->integer('rango');
            $table->string('nota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnos');
    }
};
