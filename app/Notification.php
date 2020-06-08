<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'notifications';

    public $timestamps = false;
    
    public function application()
    {   
        return $this->belongsTo('App\Application');
    }
}

