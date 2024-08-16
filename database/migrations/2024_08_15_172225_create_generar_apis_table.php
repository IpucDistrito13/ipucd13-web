<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('generar_apis', function (Blueprint $table) {
            $table->id();
            $table->string('apikey')->unique();
            $table->string('descripcion')->nullable();
            $table->enum('tipo', ['web', 'api'])->default('api'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generar_apis');
    }
};
