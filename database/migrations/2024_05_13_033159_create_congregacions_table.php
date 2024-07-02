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
        Schema::create('congregaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('municipio_id')->constrained('municipios');
            $table->string('longitud')->nullable();
            $table->string('latitud')->nullable();
            $table->text('direccion');
            $table->string('nombre')->nullable()->comment('Nombre de congregación');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('congregaciones');
    }
};
