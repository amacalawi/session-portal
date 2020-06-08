<?php

namespace Application\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes,
    	BelongsToManyUSers;

    protected $guarded = [];

    protected $table = 'applications';

    protected $searchables = ['created_at', 'updated_at'];

}
