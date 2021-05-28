<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table = 'cuentas';

    protected $fillable = [
        'item', 'valor', 'cantidad', 'huespedes_id'
    ];

    public function huesped()
    {
        return $this->belongsTo(Huespedes::class, 'huesped_id'); // FK de esta tabla
    }
}
