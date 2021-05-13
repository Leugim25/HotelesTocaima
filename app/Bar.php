<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    protected $table = 'bares';

    // Campos que se agregaran
    protected $fillable = [
        'producto', 'precio', 'codigo', 'cantidad', 'vendido',
    ];
}

