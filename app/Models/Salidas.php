<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salidas extends Model
{
    use HasFactory;
    protected $table = 'salidas';
     //clave primaria de la tabla
     protected $primaryKey =  'id_salida';
 
     //relaciones
     public $with = ['entradas'];
 
     //etiquetas de tiempo
     public $timestamps = true;
     public $incrementing = true;
 
     //tabla
     protected $fillable = [
         'id_salida',
        'id_entrada',
        'fecha_format',
        'hora_format',
        'hora',
        'dia',
        'mes',
        'anio',
        'timestamp'
     ];
 
     public function entradas(){
         return $this->belongsTo(Entradas::class, 'id_entrada', 'id_entrada');
     }
 
}
