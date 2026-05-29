<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $primaryKey = 'id_matricula';

    protected $fillable = [
        'id_alumno',
        'id_curso',
        'id_profesor',
        'id_horario',
        'semestre',
        'fecha_matricula',
        'nota_final',
        'estado',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'id_alumno', 'id_alumno');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso', 'id_curso');
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'id_profesor', 'id_profesor');
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'id_horario', 'id_horario');
    }
}