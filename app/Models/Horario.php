<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $primaryKey = 'id_horario';

    protected $fillable = [
        'id_curso',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'id_aula',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso', 'id_curso');
    }
}