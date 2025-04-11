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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
           $table->string('nombre');
            $table->string('apellidos');
            $table->string('direccion');
            $table->string('dni')->unique()->nullable();
            $table->date('fecha_nacimiento');
            $table->integer('grado_discapacidad');
            $table->text('descripcion');
            $table->boolean('esMenor');
            $table->boolean('tutoria_propia');
            $table->unsignedBigInteger('id_tutor')->nullable();
            $table->foreign('id_tutor')->references('id')->on('tutores')->onDelete('set null');
            $table->string('parentesco');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
