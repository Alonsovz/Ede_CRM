<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmAdjuntos extends Model
{
    protected $table = 'CRM_adjuntos';
    protected $dateFormat = 'Ymd H:i';
    public $timestamps = false;
    protected $connection = 'comanda';
}
