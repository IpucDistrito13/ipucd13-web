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
        Schema::create('ipuc_en_linea', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->string('url');
            $table->string('video1');
            $table->string('video2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipucen_lineas');
    }
};
