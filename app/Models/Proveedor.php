<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // nombre de la tabla 
    protected $table = 'proveedores';

    // clave primaria de la tabla 
    protected $primaryKey = 'id_proveedor';


    // // especificamos las relaciones
    // public $with = ['stock'];

    // se va utilizar etiqutas de tiempo 
    public $timestamps = true;
    public $incrementing = true;

    // tabla que se va llenar
    protected $fillable = [
        'id_proveedor',
        'nombre',
        'apellidos',
        'localidad',
        'direccion',
        'telefono',
        'correo',
        // 'id_stock',
        'activo'
    ];

    // public function stock()
    // {
    //     return $this->belongsTo(Stock::class, 'id_stock', 'id_stock');
    // }


}
