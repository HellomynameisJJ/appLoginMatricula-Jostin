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
            // Crea la columna 'google_id', permitiendo que esté vacía (nullable)
            // y la posiciona estéticamente justo debajo de la columna 'email'
            $table->string('google_id')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Si alguna vez necesitas revertir este cambio, elimina la columna
            $table->dropColumn('google_id');
        });
    }
};