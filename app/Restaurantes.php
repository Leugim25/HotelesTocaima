<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurantes extends Model
{
    protected $table = 'restaurantes';

    // Campos que se agregaran
    protected $fillable = [
        'producto', 'precio', 'codigo','vendidos'
    ];
}
