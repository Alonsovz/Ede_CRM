<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteUsuario extends Model
{
    protected $table = 'CRM_cliente_usuario';
    protected $dateFormat = 'Ymd H:i';
    protected $connection = 'comanda';
    public $timestamps = false;
}
