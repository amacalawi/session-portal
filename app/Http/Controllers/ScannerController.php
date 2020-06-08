<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Dtr;
use App\DtrLog;
use App\Device;
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

        $res = Member::where('stud_no', $id)->get();

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
                        'dateout' => date('Y-m-d'),
                        'timeout' => date('H:i:s'),
                        'total_late' => date("H:i", strtotime( ( $totallate > 0) ? date("H:i", strtotime('+' . $totallate . ' minutes', $default_time)) : '00:00:00' )),
                        'updated_on' => $timestamp
                    ]);
                }
            } else {
                if ($action == 'signin') {
                    $dtrRes = Dtr::create([
                        'member_id' => $res->first()->id,
                        'datein' => date('Y-m-d'),
                        'timein' => date('H:i:s'),
                        'created_on' => $timestamp
                    ]);
                } else {
                    $dtrRes = Dtr::create([
                        'member_id' => $res->first()->id,
                        'dateout' => date('Y-m-d'),
                        'timeout' => date('H:i:s'),
                        'created_on' => $timestamp
                    ]);
                }
            }

            if ($action == 'signin') {
                $dtrLogRes = DtrLog::create([
                    'member_id' => $res->first()->id,
                    'timelog' => date('Y-m-d H:i:s'),
                    'device_id' => (new Device)->where('name', 'mobile')->first()->id,
                    'mode' => 1,
                    'status' => 'GENERIC',
                    'created_on' => $timestamp
                ]);
            } else {
                $dtrLogRes = DtrLog::create([
                    'member_id' => $res->first()->id,
                    'timelog' => date('Y-m-d H:i:s'),
                    'device_id' => (new Device)->where('name', 'mobile')->first()->id,
                    'mode' => 0,
                    'status' => 'GENERIC',
                    'created_on' => $timestamp
                ]);
            }

            $data = array(
                'data' => $res,
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