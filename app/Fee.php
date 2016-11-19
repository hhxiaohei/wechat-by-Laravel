<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
	protected $primaryKey = 'fid';
	protected $table = 'fees';
    public $timestamps = false;
}
