<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unidad extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla si es necesario
    protected $table = 'unidades';

    protected $fillable = [
        'nombre',
        'estado',
    ];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
