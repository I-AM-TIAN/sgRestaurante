<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
use App\Models\Producto;

class Venta extends Model
{
    protected $fillable = [
        'producto_id',
        'cantidad',
        'total',
        'cliente_id'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function producto(){
        return $this->belongsTo(Producto::class);
    }
}
