<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarSection extends Model
{	
    protected $guarded = ['calendar_sections_id'];

    protected $table = 'calendar_sections';

    public $timestamps = false;
}

