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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug');
            $table->text('descripcion')->nullable();
            $table->longText('contenido')->nullable();
            $table->string('imagen_banner')
            ->comment('imagen para mostrar appbar y banner pagina 1920x500')->nullable();

            $table->foreignId('comite_id')
                ->constrained('comites');

            $table->foreignId('categoria_id')
                ->constrained('categorias');

            $table->enum('estado', ['Borrador', 'Publicado']);

            $table->foreignId('user_id')
                ->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
