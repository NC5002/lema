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
        'estado',
    ];

    public function producto()
    { 
        return $this->belongsTo(Producto::class); 
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'receta_stock', 'receta_id', 'stock_id')
                    ->withPivot('cantidad_necesaria') // Guardamos la cantidad necesaria
                    ->withTimestamps();
    }
}
