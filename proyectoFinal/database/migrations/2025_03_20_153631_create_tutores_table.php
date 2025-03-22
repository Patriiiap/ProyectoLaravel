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
        Schema::create('tutores', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('direccion');
            $table->string('password');
            $table->string('dni')->unique();
            $table->string('telefono');
            $table->string('parentesco');
            $table->string('cuenta_corriente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};
