<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingrediente extends Model
{
    use HasFactory; 
 
    protected $fillable = [ 
        'nombre', 
        'unidad_medida', 
        'cantidad_stock',
        'estado', 
    ]; 
 
    public function recetas() 
    { 
        return $this->hasMany(Receta::class); 
    } 

    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class);
    }

}
