<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id('id_matricula');
            $table->foreignId('id_alumno')->constrained('alumnos', 'id_alumno')->onDelete('cascade');
            $table->foreignId('id_curso')->constrained('cursos', 'id_curso')->onDelete('cascade');
            $table->foreignId('id_profesor')->nullable()->constrained('profesores', 'id_profesor')->nullOnDelete();
            $table->foreignId('id_horario')->nullable()->constrained('horarios', 'id_horario')->nullOnDelete();
            $table->string('semestre');
            $table->date('fecha_matricula');
            $table->decimal('nota_final', 5, 2)->nullable();
            $table->enum('estado', ['aprobado', 'reprobado', 'cursando'])->default('cursando');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};