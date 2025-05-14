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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('cita');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_profesional');
            $table->string('asistencia_realizada')->default('pendiente');
            $table->boolean('recurrente')->default(false);  // Indica si es recurrente
            $table->integer('frecuencia')->default(0);  // Número de repeticiones si es recurrente
            $table->dateTime('proxima_fecha_inicio')->nullable();  // Fecha de la próxima cita
            $table->dateTime('proxima_fecha_fin')->nullable();  // Fecha de la próxima cita
            $table->foreign('id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('id_profesional')->references('id')->on('profesionales')->onDelete('cascade');
            $table->unique(['id_usuario', 'id_profesional', 'fecha_inicio', 'fecha_fin'], 'cita_unica');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
