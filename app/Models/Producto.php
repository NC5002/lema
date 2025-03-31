<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class Producto extends Model
{
    use HasFactory; 
 
    protected $fillable = [ 
        'nombre', 
        'descripcion', 
        'categoria_id', 
        'precio_venta', 
        'imagen', 
        'estatus', 
    ]; 
 
    public function categoria() 
    { 
        return $this->belongsTo(Categoria::class); 
    } 
 
    public function recetas() 
    { 
        return $this->hasMany(Receta::class); 
    }
}
