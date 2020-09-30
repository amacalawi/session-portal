<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{	
    protected $guarded = ['calendar_id'];

    protected $table = 'calendar';

    public $timestamps = false;
}

