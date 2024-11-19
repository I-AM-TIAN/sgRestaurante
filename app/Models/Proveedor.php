<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'nit',
        'razonSocial',
        'direccion',
        'telefono',
        'email',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'proveedor_id');
    }
}
