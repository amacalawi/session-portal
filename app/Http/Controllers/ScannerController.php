<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Dtr;
use App\DtrLog;
use App\Device;
use App\Schoolyear;
use App\Calendar;
use App\CalendarSection;
use App\CalendarTimeSetting;
Use DB; 

class ScannerController extends Controller
{
    
    public function __construct()
    {
        date_default_timezone_set('Asia/Manila');
    }
    
    public function index(Request $request)
    {   
        $timestamp = date('Y-m-d H:i:s');
        $id = $request->get('id'); 
        $action = $request->input('action');
        $day = date("D");
        $default_time = strtotime('00:00:00');
        $school_year  = Schoolyear::where('status', 'CURRENT')->first()->id;

        $res = Member::select('members.id', 'members.stud_no', 'members.firstname', 'members.lastname', 'members.msisdn', 'enrollments.type', 'enrollments.schedule_id')
        ->join('enrollments', function($join)
        {   
            $join->on('members.id', '=', 'enrollments.member_id');
        })
        ->where([
            'enrollments.schoolyear_id' => $school_year,
            'members.stud_no' => $id
        ])->get();

        if ($res->count() > 0) {

            $dtr = Dtr::where([
                'member_id' => $res->first()->id,
            ])->where(function ($query) {
                $query->where('datein', '=', date('Y-m-d'))
                      ->orWhere('dateout', '=', date('Y-m-d'));
            })->get();
            
            if ($dtr->count() > 0) {
                if ($action == 'signin') {
                    $dtrRes = Dtr::where('id', $dtr->first()->id)
                    ->update([
                        'datein' => date('Y-m-d'),
                        'timein' => date('H:i:s'),
                        'updated_on' => $timestamp
                    ]);
                } else {
                    
                    $dtrlogs = DtrLog::join('members', function($join)
                    {
                        $join->on('members.id', '=', 'dtr_log.member_id');
                    })
                    ->where('dtr_log.timelog', 'like', '%' . date('Y-m-d') . '%')
                    ->where('dtr_log.mode', 1)
                    ->where('members.stud_no', $id)
                    ->get();
                    
                    $timelog = ($dtrlogs->count() > 0) ? date("H:i:s", strtotime($dtrlogs->first()->timelog)) : 0;

                    $totallate = 0;

                    if($timelog != 0)
                    {
                        $time_in_hr = Date("H", strtotime($timelog)) * 60 ;
                        $time_in_min  = Date("i", strtotime($timelog));

                        $reg_in_hr = Date("H", strtotime( (new DTR)->get_scheduled_latein_dtr($res->first()->id, $day) )) * 60;
                        $reg_in_min  = (Date("i", strtotime( (new DTR)->get_scheduled_latein_dtr($res->first()->id, $day))) - 1);

                        if($time_in_hr > $reg_in_hr)
                        {
                            $minutes = ($time_in_hr + $time_in_min) - ($reg_in_hr + $reg_in_min);
                            $totallate = floatval($totallate) + floatval($minutes);

                        } 
                        else if (($time_in_hr == ($reg_in_hr)) && $time_in_min > 0)
                        {
                            $totallate = floatval($totallate) + floatval($time_in_min);
                        }	
                    }

                    $dtrRes = Dtr::where('id', $dtr->first()->id)
                    ->update([
                        'dateout' => date('Y-m-d', strtotime($timestamp)),
                        'timeout' => date('H:i:s', strtotime($timestamp)),
                        'total_late' => date("H:i", strtotime( ( $totallate > 0) ? date("H:i", strtotime('+' . $totallate . ' minutes', $default_time)) : '00:00:00' )),
                        'updated_on' => $timestamp
                    ]);
                }
            } else {
                if ($action == 'signin') {
                    $dtrRes = Dtr::create([
                        'member_id' => $res->first()->id,
                        'datein' => date('Y-m-d', strtotime($timestamp)),
                        'timein' => date('H:i:s', strtotime($timestamp)),
                        'created_on' => $timestamp
                    ]);
                } else {
                    $dtrRes = Dtr::create([
                        'member_id' => $res->first()->id,
                        'dateout' => date('Y-m-d', strtotime($timestamp)),
                        'timeout' => date('H:i:s', strtotime($timestamp)),
                        'created_on' => $timestamp
                    ]);
                }
            }

            $full_day = $this->fullday(date("D", strtotime($timestamp)));
            $mode = ($action == 'signin') ? 1 : 0;
            $calendarOverwrite = $this->checkCalendarStud( date("Y-m-d", strtotime($timestamp)), $res->first()->stud_no);

            if ($calendarOverwrite > 0) {

				if ($res->first()->type == 1) {
					$type = 0;
				} else if ($res->first()->type == 2) {
					$type = 1;
				} else {
					$type = -1;
				}

				$calendar_id = $this->get_calendar_id(date("Y-m-d", strtotime($timestamp)), $res->first()->type);
				$time = date("H:i:s", strtotime($timestamp));

				if ($calendar_id > 0){
					$status = $this->get_calendar_time_settings($calendar_id, $time);
				} else {
					$status = $this->check_schedule($res->first()->stud_no, date("H:i:s", strtotime($timestamp)), $mode, $full_day);
				}

			}else {
				$status = $this->check_schedule($res->first()->stud_no, date("H:i:s", strtotime($timestamp)), $mode, $full_day);
			}

            $dtrLogRes = DtrLog::create([
                'member_id' => $res->first()->id,
                'timelog' => $timestamp,
                'device_id' => (new Device)->where('name', 'mobile')->first()->id,
                'mode' => $mode,
                'status' => $status,
                'created_on' => $timestamp
            ]);

            $send_data = array(
			    "stud_no" => $res->first()->stud_no,
			    "stud_name" => $res->first()->firstname.' '.$res->first()->lastname,
			    "mode" => ($action == 'signin') ? 1 : 0, 
			    "date" => date("M-d-y", strtotime($timestamp)),
			    "time" => date("H:i:s", strtotime($timestamp)),
			    "msisdn" => $res->first()->msisdn,
			    "is_timein" => ($action == 'signin') ? true : false,
			    "is_timeout" => ($action == 'signin') ? false : true,
			    "full_day" => $this->fullday(date("D", strtotime($timestamp))),
			    "schedule_id" => $res->first()->schedule_id,
			    "calendarOverwrite" => $calendarOverwrite
            );
            
            $is_timein = ($action == 'signin') ? true : false;
            $is_timeout = ($action == 'signin') ? false : true;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://'.$_SERVER['SERVER_NAME'].'/samsv4/executes?datas='.urlencode(serialize($send_data)));
            // curl_setopt($ch, CURLOPT_URL, 'http://www.samsv4.com/executes?datas='.urlencode(serialize($send_data)));
            
            // curl_setopt($ch, CURLOPT_URL, 'http://'.$_SERVER['SERVER_NAME'].'/www.samsv4.com/executes?stud_no='.urlencode($res->first()->stud_no).'&stud_name='.urlencode($res->first()->firstname.' '.$res->first()->lastname).'&mode='.urlencode($mode).'&date='.urlencode(date("M-d-y", strtotime($timestamp))).'&time='.urlencode(date("H:i:s", strtotime($timestamp))).'&msisdn='.urlencode($res->first()->msisdn).'&is_timein='.urlencode($is_timein).'&is_timeout='.urlencode($is_timeout).'&full_day='.urlencode($this->fullday(date("D", strtotime($timestamp)))).'&schedule_id='.urlencode($res->first()->schedule_id).'&calendarOverwrite='.urlencode($calendarOverwrite).'');
            // curl_setopt($ch, CURLOPT_HEADER, 0);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1);
            curl_exec($ch);
            curl_close($ch);
            
            $data = array(
                'data' => $res,
                'url' => 'http://'.$_SERVER['SERVER_NAME'].'/samsv4/executes?datas='.urlencode(serialize($send_data)),
                'device' => (new Device)->where('name', 'mobile')->first()->id,
                'message' => 'the user was successfully signedin.',
                'type'    => 'success'
            );

            echo json_encode( $data ); exit();

        } else {
            $data = array(
                'data' => $id,
                'message' => 'the user was not successfully signedin.',
                'type'    => 'failed'
            );

            echo json_encode( $data ); exit();
        }
    }

    public function checkCalendarStud($date, $studNo)
    {   
        $calendars = 0; $sections = 0;
        $school_year  = Schoolyear::where('status', 'CURRENT')->first()->id;
        $calendar = Calendar::where('calendar_start', 'like', '%' . $date . '%')->get();

        if ($calendar->count() > 0) {
            $calendars = 1;

            $calendar_section = CalendarSection::where([
                'calendar_id' => $calendar->first()->calendar_id,
                'active' => 1
            ])->get();

            if ($calendar_section->count() > 0) {

                $res = Member::join('enrollments', function($join)
                {   
                    $join->on('members.id', '=', 'enrollments.member_id');
                })
                ->join('sections', function($join)
                {   
                    $join->on('enrollments.sections_id', '=', 'sections.sections_id');
                })
                ->where([
                    'enrollments.schoolyear_id' => $school_year,
                    'members.stud_no' => $studNo,
                    'sections.sections_id' => $calendar_section->first()->sections_id
                ])
                ->groupBy('members.id')
                ->get();

                if ($res->count() > 0)
                {
                    $sections = 1;
                }
            }
        }

        if (floatval($calendars) > 0 && floatval($sections) > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function get_calendar_id($date, $member_type)
    {   
        $calendar = 0; $section = 0;
        $school_year  = Schoolyear::where('status', 'CURRENT')->first()->id;

        $calendar = Calendar::where('calendar_start', 'like', '%' . $date . '%')
        ->where([
            'active' => 1,
            'type' => $member_type,
            'calendar_type' => 'custom-day'
        ])
        ->get();

        if ($calendar->count() > 0) {
            return $calendar->first()->calendar_id;
        } else {
            return 0;
        }
    }

    public function get_calendar_time_settings($calendar_id, $time_log) 
    {
        $calendar_time_setting = CalendarTimeSetting::where('calendar_id', $calendar_id)
        ->where('time_from', '<=', $time_log)
        ->where('time_to', '>=', $time_log)
        ->get();

        if ($calendar_time_setting->count() > 0) {
            return $calendar_time_setting->first()->name;
        } else {
            return 0;
        }
    }

    public function check_schedule($student, $timed_in, $mode, $day)
    {   
        $res = Member::select('dtr_time_settings.name')
        ->join('enrollments', function($join)
        {   
            $join->on('members.id', '=', 'enrollments.member_id');
        })
        ->join('schedules', function($join)
        {   
            $join->on('schedules.id', '=', 'enrollments.schedule_id');
        })
        ->join('dtr_time_settings', function($join)
        {   
            $join->on('dtr_time_settings.schedule_id', '=', 'schedules.id');
        })
        ->join('dtr_time_days', function($join)
        {   
            $join->on('dtr_time_days.dtrts_id', '=', 'dtr_time_settings.id');
        })
        ->where('dtr_time_days.time_from', '<=', $timed_in)
        ->where('dtr_time_days.time_to', '>=', $timed_in)
        ->where('dtr_time_days.day', $day)
        ->where('dtr_time_settings.mode', $mode)
        ->where('members.stud_no', $student)
        ->get();
        
        if ($res->count() > 0) {
            return $res->first()->name;
        } else {
            return "GENERIC";
        }
    }

    public function fullday($day)
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
    			# code...
    			break;
    	}

    	return $day;
    }

}