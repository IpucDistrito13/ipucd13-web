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
        Schema::table('congregaciones', function (Blueprint $table) {
            $table->text('googlemaps')->nullable()->comment('Url Google Maps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('congregaciones', function (Blueprint $table) {
            $table->dropColumn('googlemaps');
        });
    }
};
