<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $fillable = ['numeroMesa', 'capacidad'];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
