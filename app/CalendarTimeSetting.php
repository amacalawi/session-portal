<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarTimeSetting extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'calendar_time_settings';

    public $timestamps = false;
}

