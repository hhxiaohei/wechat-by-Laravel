<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'Orders';
    protected $primaryKey = 'oid';
    public $timestamps = false;
}
