<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $connection = 'facturacion';
    protected $table = 'FE_CLIENTE';
}
