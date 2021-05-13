<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piscinas extends Model
{
    protected $table = 'piscinas';

    // Campos que se agregaran
    protected $fillable = [
        'opcion', 'precio'
    ];}
