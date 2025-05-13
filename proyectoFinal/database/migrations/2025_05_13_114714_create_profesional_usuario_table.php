<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'profesionales_usuarios';

    public function up(): void
    {
        Schema::create('profesionales_usuarios', function (Blueprint $table) {
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->foreignId('profesional_id')->constrained('profesionales')->onDelete('cascade');

            $table->primary(['usuario_id', 'profesional_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profesionales_usuarios');
    }
};
