<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    // Especifica la tabla asociada con el modelo
    protected $table = 'estudiantes';

    // Define los campos que se pueden asignar en masa
    protected $fillable = [
        'nombre',
        'apellido',
        'salon',
        'grado',
        'dni',
    ];
}
