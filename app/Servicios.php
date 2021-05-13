<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $table = 'servicios';

    // Campos que se agregaran
    protected $fillable = [
        'restaurante_id', 'piscina_id', 'bar_id',
    ];

    public function restaurante()
    {
        return $this->belongsTo(Restaurantes::class, 'restaurante_id');
    }

    public function piscina()
    {
        return $this->belongsTo(Piscinas::class, 'piscina_id');
    }

    public function bar()
    {
        return $this->belongsTo(Bar::class, 'bar_id');
    }
}
