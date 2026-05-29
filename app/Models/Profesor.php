<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $primaryKey = 'id_profesor';

    protected $fillable = [
        'nombre',
        'apellidos',
        'especialidad',
    ];

    public function matriculas()
    {
        return $this->hasMany(Matricula::class, 'id_profesor', 'id_profesor');
    }
}