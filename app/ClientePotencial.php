<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientePotencial extends Model
{
    protected $table = 'CRM_clientes';
    protected $dateFormat = 'Ymd H:i';
    public $timestamps = false;
    protected $connection = 'comanda';
}
