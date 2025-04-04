<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use App\Traits\TracksUser; //Falta migrate de recetas

class Receta extends Model
{
    use HasFactory; 
 
    protected $fillable = [ 
        'producto_id', 
        'ingrediente_id', 
        'cantidad_necesaria', 
        'estado',
    ]; 
 
    public function producto() 
    { 
        return $this->belongsTo(Producto::class); 
    } 
 
    public function ingrediente() 
    { 
        return $this->belongsTo(Ingrediente::class); 
    } 

}
