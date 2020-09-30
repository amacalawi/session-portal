<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolyear extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'schoolyears';

    public $timestamps = false;
}

