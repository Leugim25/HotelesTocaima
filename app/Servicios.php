<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $table = 'servicios';

    // Campos que se agregaran
    protected $fillable = [
        'nombre_servicio', 'color',
    ];

    public function items()
    {
        return $this->hasMany('App\Items','servicios_id');
    }
    
}
