<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;
    //nombre de la tabla
    protected $table = 'empleados';
    //clave primaria de la tabla
    protected $primaryKey =  'id_empleado';

    //etiquetas de tiempo
    public $timestamps = true;
    public $incrementing = true;

    //tabla
    protected $fillable = [
        'id_empleado',
        'n_empleado',
        'nombres',
        'apellidos',
        'ciudad',
        'direccion',
        'telefono',
        'nss',
        'activo'
    ];
}
