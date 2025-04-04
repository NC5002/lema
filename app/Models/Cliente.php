<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use App\Traits\TracksUser;

class Cliente extends Model
{
    use HasFactory; 
 
    protected $fillable = [ 
        'nombre', 
        'identificacion', 
        'telefono', 
        'email', 
        'direccion',
        'estado', 
    ];
}
