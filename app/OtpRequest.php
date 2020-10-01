<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtpRequest extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'otp_request';

    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo('App\Member', 'memder_id', 'id');
    }
}

