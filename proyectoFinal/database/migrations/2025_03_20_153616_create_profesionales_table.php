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
        Schema::create('profesionales', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('direccion');
            $table->string('password');
            $table->string('dni')->unique();
            $table->string('telefono');
            $table->boolean('esPati')->default(false);
            $table->boolean('esPap')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesionales');
    }
};
