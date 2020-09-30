<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtrLog extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'dtr_log';

    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo('App\Member', 'memder_id', 'id');
    }
}

