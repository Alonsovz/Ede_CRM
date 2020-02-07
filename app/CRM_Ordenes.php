<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CRM_Ordenes extends Model
{
    protected $table = 'CRM_ordenes_trabajo';
    public $timestamps = false;
    protected $connection = 'comanda';
    protected $dateFormat = 'Ymd H:i';
}
