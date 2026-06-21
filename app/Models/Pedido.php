<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
        'direccion',
        'metodo_pago',
        'total',
        'estado'
    ];
    public function detalles()
    {
    return $this->hasMany(PedidoDetalle::class);
    }
}

