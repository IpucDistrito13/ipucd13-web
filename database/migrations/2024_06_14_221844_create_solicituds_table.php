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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('solicitud_tipo_id')->constrained('solicitud_tipos');
            $table->string('url')->nullable();
            $table->foreignId('user_solicitud')->constrained('users');
            $table->foreignId('user_response')->nullable()->constrained('users');
            $table->enum('estado', ['0', '1']); // 0 = Sin respuesta - 1 = enviado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
