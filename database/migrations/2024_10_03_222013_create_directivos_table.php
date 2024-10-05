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
        Schema::create('directivos', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('lidertipo_id')->constrained('directivo_tipos');
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('user_created')->constrained('users');
            $table->enum('estado', ['Activo', 'Inactivo']); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directivos');
    }
};
