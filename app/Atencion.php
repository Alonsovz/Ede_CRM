<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{

    protected $dateFormat = 'Ymd H:i';
    protected $connection = 'comanda';
    protected $table = 'CRM_atenciones';
    public $timestamps = false;
}
