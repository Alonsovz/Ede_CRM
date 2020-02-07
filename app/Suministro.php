<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suministro extends Model
{
    protected $connection = 'facturacion';
    protected $table ='FE_SUMINISTROS';
}
