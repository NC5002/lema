<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use App\Traits\TracksUser;

class Ingrediente extends Model
{
    use HasFactory; 
 
    protected $fillable = [ 
        'nombre', 
        'unidad_medida', 
        'cantidad_stock',
        'estado', 
        'created_by', // ✅ Añade estos si no están
        'updated_by',
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
