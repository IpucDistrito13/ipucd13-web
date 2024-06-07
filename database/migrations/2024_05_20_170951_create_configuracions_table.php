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
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_titulo')->nullable()->comment('Muetra en la pagina principal');
            $table->string('distrito_titulo')->nullable()->comment('Muestra en la pagina principal');

            //Configuracion del sistema
            $table->string('nombre')->nullable()->comment('');
            $table->string('apellidos')->nullable();
            $table->string('email')->nullable()->comment('email principal del sistema');
            $table->string('password')->nullable();

            //SEO
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracions');
    }
};
