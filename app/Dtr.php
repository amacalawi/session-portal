<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dtr extends Model
{	
    protected $guarded = ['id'];

    protected $table = 'dtr';

    public $timestamps = false;

    public function member()
    {
        return $this->belongsTo('App\Member', 'memder_id', 'id');
    }

    public function get_scheduled_latein_dtr($id, $day)
    {
        switch ($day) {
            case 'Mon':
                $day = 'monday';
                break;
            
            case 'Tue':
                $day = 'tuesday';
                break;

            case 'Wed':
                $day = 'wednesday';
                break;

            case 'Thu':
                $day = 'thursday';
                break;
            
            case 'Fri':
                $day = 'friday';
                break;

            case 'Sat':
                $day = 'saturday';
                break;

            case 'Sun':
                $day = 'sunday';
                break;  

            default:
                $day = $day;
                break;
        }

        $query = \DB::table('dtr_time_days')->distinct('dtr_time_days.time_from')
        ->join('dtr_time_settings', 'dtr_time_settings.id', '=', 'dtr_time_days.dtrts_id')
        ->join('schedules', 'schedules.id', '=', 'dtr_time_settings.schedule_id')
        ->join('enrollments', 'enrollments.schedule_id', '=', 'schedules.id')
        ->join('members', 'enrollments.member_id', '=', 'members.id')
        ->join('dtr_log', 'members.id', '=', 'dtr_log.member_id')
        ->where([
            'dtr_time_settings.name' => 'LATE_IN',
            'dtr_time_days.day' => $day,
            'members.id' => $id
        ])
        ->get();

        $results = 0;

        if($query->count() > 0)
        {
            $results = $query->first()->time_from;
        }
        else
        {
            return $results;
        }    
    }
}

