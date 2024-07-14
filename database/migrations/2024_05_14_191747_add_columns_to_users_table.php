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
        Schema::table('users', function (Blueprint $table) {
            $table->string('uuid')->nullable();

            $table->string('codigo')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('celular')->nullable();
            $table->boolean('visible_celular');
            $table->boolean('isbloqueo')->nullable();

            $table->string('telefono')->nullable();
            //Todos los usuarios asociados a esa congregación tendrán su congregacion_id establecido a NULL automáticamente.
            $table->foreignId('congregacion_id')
                ->nullable()
                ->constrained('congregaciones')
                ->onDelete('cascade');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');

            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
