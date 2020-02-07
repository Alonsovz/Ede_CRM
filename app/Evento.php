<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'CRM_eventos';
    public $timestamps = false;
    protected $dateFormat = 'Ymd H:i';
    protected $connection = 'comanda';
}
