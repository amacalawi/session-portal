<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'devices';

    public $timestamps = false;
}

