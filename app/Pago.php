<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = ['pago'];

    protected $table =  'pagos';
}
