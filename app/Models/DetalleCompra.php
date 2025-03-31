<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleCompra extends Model
{
    use HasFactory; 
 
    protected $fillable = [ 
        'compra_id', 
        'ingrediente_id', 
        'cantidad_comprada', 
        'precio_unitario', 
        'subtotal', 
    ]; 
 
    public function compra() 
    { 
        return $this->belongsTo(Compra::class); 
    } 
 
    public function ingrediente() 
    { 
        return $this->belongsTo(Ingrediente::class); 
    } 
}
