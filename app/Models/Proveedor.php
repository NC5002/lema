<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use App\Traits\TracksUser;

class Proveedor extends Model
{
    use HasFactory; 

    // Especificamos el nombre de la tabla para que no exista confuciones En/Es
    protected $table = 'proveedores';
 
    protected $fillable = [ 
        'nombre', 
        'telefono', 
        'email', 
        'direccion', 
        'estado',
    ]; 

}
