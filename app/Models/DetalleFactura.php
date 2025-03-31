<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


class DetalleFactura extends Model
{
    use HasFactory; 
 
    protected $fillable = [ 
        'facturas_id', 
        'producto_id', 
        'cantidad', 
        'precio_unitario', 
        'subtotal', 
    ]; 
 
    public function factura() 
    { 
        return $this->belongsTo(Factura::class, 'facturas_id'); 
    } 
 
    public function producto() 
    { 
        return $this->belongsTo(Producto::class); 
    } 

}
