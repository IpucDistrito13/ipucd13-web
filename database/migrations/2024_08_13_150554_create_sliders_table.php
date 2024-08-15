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
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable()->commet('Titutlo');
            $table->string('subtitulo')->nullable();
            $table->string('buttontext')->nullable()->comment('Texto del boton');
            $table->text('url')->nullable()->commet('url donde redirecciona');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
