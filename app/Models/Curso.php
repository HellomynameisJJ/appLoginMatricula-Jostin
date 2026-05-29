<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $primaryKey = 'id_curso';

    protected $fillable = [
        'nombre_curso',
        'codigo_curso',
        'creditos',
        'descripcion',
    ];

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_curso', 'id_curso');
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'id_curso', 'id_curso');
    }
}