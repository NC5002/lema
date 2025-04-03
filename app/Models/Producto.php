<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use App\Traits\TracksUser;

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
        'stock',
    ]; 
 
    public function categoria() 
    { 
        return $this->belongsTo(Categoria::class); 
    } 
 
    public function recetas() 
    { 
        return $this->hasMany(Receta::class); 
    }

    public function detallesFactura()
    {
        return $this->hasMany(DetalleFactura::class);
    }

}
