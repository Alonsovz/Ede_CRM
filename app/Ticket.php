<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    public $timestamps = false;
    protected $dateFormat = 'Ymd H:i';
    protected $connection = 'comanda';
}
