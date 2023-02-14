<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entradas extends Model
{
    use HasFactory;
     //nombre de la tabla
     protected $table = 'entradas';
     //clave primaria de la tabla
     protected $primaryKey =  'id_entrada';
 
     //relaciones
     public $with = ['empleados'];
 
     //etiquetas de tiempo
     public $timestamps = true;
     public $incrementing = true;
 
     //tabla
     protected $fillable = [
         'id_entrada',
         'id_empleado',
         'fecha_format',
         'hora_format',
         'hora',
         'dia',
         'mes',
         'anio',
         'timestamp'
     ];
 
     public function empleados(){
         return $this->belongsTo(Empleados::class, 'id_empleado', 'id_empleado');
     }
 
}
