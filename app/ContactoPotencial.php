<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactoPotencial extends Model
{
    protected $table = 'CRM_contactos_clientes';
    protected $dateFormat = 'Ymd H:i';
    public $timestamps = false;
    protected $connection = 'comanda';
}
