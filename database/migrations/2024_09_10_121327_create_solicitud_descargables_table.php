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
        Schema::create('solicitud_descargables', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->text('slug');
            $table->text('descripcion')->nullable();
            $table->text('url')->nullable();
            $table->string('uuid');
            $table->text('nombre_original')->nullable();
            $table->enum('tipo', ['Archivo', 'Enlace', 'Otro'])->comment('Tipo Archivo o enlace externo');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_descargables');
    }
};
