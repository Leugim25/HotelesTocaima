<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditorias extends Model
{
    protected $fillable = [
        'description', 'user_name',
    ];
}
