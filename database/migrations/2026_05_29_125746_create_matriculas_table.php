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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->foreign('id_alumno')->references ('id')->on('alumnos'->onDelete('cascade');
            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')->references('id')->on('cursos')->onDelete('cascade');
            $table->unsignedBigInteger('id_profesor')->nullable();
            $table->foreign('id_profesor')->references('id')->on('profesores')->onDelete('set null');
            $table->unsignedBigInteger('id_horario')->nullable();
            $table->foreign('id_horario')->references('id')->on('horarios')->onDelete('set null');
            $table->string('semestre');
            $table->date('fecha_matricula');
            $table->decimal('nota_final', 5, 2)->nullable();
            $table->enum('estado', ['aprobado', 'reprobado', 'cursando'])->default('cursando');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
