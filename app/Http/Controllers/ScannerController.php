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
use App\OtpRequest;
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
        $levels = array(29, 30, 31, 32, 33, 34);

        $res = Member::select('members.id', 'members.stud_no', 'members.firstname', 'members.lastname', 'members.msisdn', 'enrollments.type', 'enrollments.schedule_id')
        ->join('enrollments', function($join)
        {   
            $join->on('members.id', '=', 'enrollments.member_id');
        })
        ->whereIn('enrollments.levels_id', $levels)
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
            curl_setopt($ch, CURLOPT_URL, 'https://192.168.5.50/samsv4/executes?datas='.urlencode(serialize($send_data)));
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            
            $data = array(
                'data' => $res,
                'url' => 'https://'.$_SERVER['SERVER_NAME'].'/samsv4/executes?datas='.urlencode(serialize($send_data)),
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

    public function request_otp(Request $request)
    {   
        $timestamp = date('Y-m-d H:i:s');
        $sql = "UPDATE otp_request SET is_expired = 1 WHERE created_at < DATE_SUB(NOW(),INTERVAL 2 MINUTE)";
        $result = DB::select($sql);
        $school_year  = Schoolyear::where('status', 'CURRENT')->first()->id;
        $levels = array(29, 30, 31, 32, 33, 34);

        $member = Member::select('members.id', 'members.stud_no', 'members.firstname', 'members.lastname', 'members.msisdn', 'enrollments.levels_id', 'enrollments.type', 'enrollments.schedule_id')
        ->join('enrollments', function($join)
        {   
            $join->on('members.id', '=', 'enrollments.member_id');
        })
        ->whereIn('enrollments.levels_id', $levels)
        ->where([
            'members.stud_no' => $request->get('id_number'),
            'enrollments.schoolyear_id' => $school_year
        ])
        ->get();

        if ($member->count() > 0) {
            $random = mt_rand(10000, 50000);

            $otp_request = OtpRequest::create([
                'member_id' => $member->first()->id,
                'otp_number' => $random,
                'created_at' => $timestamp
            ]);


            $send_data = array(
                'id' => $otp_request->id,
			    "member_id" => $otp_request->member_id,
			    "otp_number" => $otp_request->otp_number
            );

            $ch = curl_init();
            $url = 'https://'.$_SERVER['SERVER_NAME'].'/samsv4/otp-request?datas='.urlencode(serialize($send_data));
            curl_setopt($ch, CURLOPT_URL, 'https://192.168.5.50/samsv4/otp-request?datas='.urlencode(serialize($send_data)));
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            $data = array(
                'data'    => $url,
                'message' => 'the information has successfully sent.',
                'type'    => 'success'
            );

            echo json_encode( $data ); exit();
        } else {
            $data = array(
                'data'    => $request->get('id_number'),
                'message' => 'the information has successfully sent.',
                'type'    => 'failed'
            );

            echo json_encode( $data ); exit();
        }
    }

    public function scan_otp(Request $request)
    {   
        $timestamp = date('Y-m-d H:i:s');
        $id = $request->get('id'); 
        $otp = $request->get('otp'); 
        $action = $request->input('action');
        $day = date("D");
        $default_time = strtotime('00:00:00');
        $school_year  = Schoolyear::where('status', 'CURRENT')->first()->id;
        $levels = array(29, 30, 31, 32, 33, 34);

        $res = Member::select('members.id', 'members.stud_no', 'members.firstname', 'members.lastname', 'members.msisdn', 'enrollments.levels_id', 'enrollments.type', 'enrollments.schedule_id')
        ->join('enrollments', function($join)
        {   
            $join->on('members.id', '=', 'enrollments.member_id');
        })
        ->whereIn('enrollments.levels_id', $levels)
        ->where([
            'enrollments.schoolyear_id' => $school_year,
            'members.stud_no' => $id
        ])->get();

        $res2 = OtpRequest::where([
            'member_id' => $res->first()->id,
            'otp_number' => $otp,
            'is_expired' => 0
        ])->get();

        if ($res->count() > 0 && $res2->count() > 0) {

            $otp_request = OtpRequest::where('id', $res2->first()->id)
            ->update(['is_done' => 1, 'is_expired' => 1]);

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
            curl_setopt($ch, CURLOPT_URL, 'https://192.168.5.50/samsv4/executes?datas='.urlencode(serialize($send_data)));
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            
            $data = array(
                'data' => $res,
                'url' => 'https://'.$_SERVER['SERVER_NAME'].'/samsv4/executes?datas='.urlencode(serialize($send_data)),
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
}