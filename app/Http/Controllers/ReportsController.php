<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;

class ReportsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $types = array('' => 'select an application type', 'All' => 'All', '4' => 'Copyright', '5' => 'Industrial Design', '1' => 'Patent', '2' => 'Utility Model', '3' => 'Trademark');
        $orders = array('' => 'select an order', 'ASC' => 'Ascending', 'DESC' => 'Descending');
        return view('reports')->with(compact('types', 'orders'));
    }

    public function export(Request $request)
    {
        $dateFrom = date('Y-m-d', strtotime($request->input('date_from')));
        $dateTo   = date('Y-m-d', strtotime($request->input('date_to')));

        if ($request->input('type') == 'All') {
            $applications = Application::with([
                'category' => function($q) { 
                    $q->select(['category_id', 'category_name']); 
                },
                'applicants' =>  function($q) { 
                    $q->select(['application_id', 'fullname']); 
                },
                'inventors' =>  function($q) { 
                    $q->select(['application_id', 'fullname']); 
                }
            ])->whereBetween('application_filing_date', [ $dateFrom, $dateTo ])
            ->orderBy('application_filing_date', $request->order_by)->get();

            $applications = $applications->map(function($app) {
                return [
                    'category' => $app->category->category_name,
                    'id' => $app->id,
                    'application_no' => $app->application_no,
                    'application_title' => $app->application_title,
                    'application_contact_no' => $app->application_contact_no,
                    'applicants' => str_replace(str_split('[]'), "", trim($app->applicants->map(function($a) { return ''.ucwords($a->fullname); }))),
                    'inventors' => str_replace(str_split('[]'), "", trim($app->inventors->map(function($a) { return ''.ucwords($a->fullname); }))),
                    'application_remarks' => $app->application_remarks,
                    'application_filing_date' => $app->application_filing_date,
                    'paper_no' => ($app->fer_yes_no == 'No') ? $app->fer_paper_no1 : $app->fer_paper_no2,
                    'mailing_date' => ($app->fer_yes_no == 'No') ? $app->fer_mailing_date1 : $app->fer_mailing_date2,
                    'publication_date' => $app->published_date,
                    'issuance_date' => $app->issuance_date,
                    'allowance_remarks' => $app->allowance_remarks,
                    'total_government_fees' => floatval($app->application_amount) + floatval($app->fer_amount_file1) + floatval($app->fer_amount_file2) + floatval($app->published_amount) + 
                    floatval($app->registration_amount) + floatval($app->ser_amount_file1) + floatval($app->ser_amount_file2) + floatval($app->allowance_amount_file),
                    'total_professional_fees' => floatval($app->professional_fee1) + floatval($app->professional_fee2_1) + floatval($app->professional_fee2_2) +
                    floatval($app->professional_fee3) + floatval($app->professional_fee4_1) + floatval($app->professional_fee4_2) + floatval($app->professional_fee5)
                ];
            });
        } else {
            $applications = Application::with([
                'applicants' =>  function($q) { 
                    $q->select(['application_id', 'fullname']); 
                },
                'inventors' =>  function($q) { 
                    $q->select(['application_id', 'fullname']); 
                }
            ])->where('category_id', $request->input('type'))
            ->whereBetween('application_filing_date', [ $dateFrom, $dateTo ])
            ->orderBy('application_filing_date', $request->input('order_by'))->get();

            $applications = $applications->map(function($app) {
                return [
                    'category' => $app->category->category_name,
                    'id' => $app->id,
                    'application_no' => $app->application_no,
                    'application_title' => $app->application_title,
                    'application_contact_no' => $app->application_contact_no,
                    'applicants' => str_replace(str_split('[]'), "", trim($app->applicants->map(function($a) { return ''.ucwords($a->fullname); }))),
                    'inventors' => str_replace(str_split('[]'), "", trim($app->inventors->map(function($a) { return ''.ucwords($a->fullname); }))),
                    'application_remarks' => $app->application_remarks,
                    'application_filing_date' => $app->application_filing_date,
                    'paper_no' => ($app->fer_yes_no == 'No') ? $app->fer_paper_no1 : $app->fer_paper_no2,
                    'mailing_date' => ($app->fer_yes_no == 'No') ? $app->fer_mailing_date1 : $app->fer_mailing_date2,
                    'publication_date' => $app->published_date,
                    'issuance_date' => $app->issuance_date,
                    'allowance_remarks' => $app->allowance_remarks,
                    'total_government_fees' => floatval($app->application_amount) + floatval($app->fer_amount_file1) + floatval($app->fer_amount_file2) + floatval($app->published_amount) + 
                    floatval($app->registration_amount) + floatval($app->ser_amount_file1) + floatval($app->ser_amount_file2) + floatval($app->allowance_amount_file),
                    'total_professional_fees' => floatval($app->professional_fee1) + floatval($app->professional_fee2_1) + floatval($app->professional_fee2_2) +
                    floatval($app->professional_fee3) + floatval($app->professional_fee4_1) + floatval($app->professional_fee4_2) + floatval($app->professional_fee5)
                ];
            });
        }

        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($applications, [
            'application_no' => 'APPLICATION NO',
            'category' => 'CATEGORY',
            'applicants' => 'APPLICANTS',
            'inventors' => 'INVENTORS',
            'application_contact_no' => 'CONTACT NO',
            'application_title' => 'TITLE',
            'application_remarks' => 'CLIENT INFORMATION REMARKS',
            'application_filing_date' => 'FILING DATE',
            'paper_no' => 'FORMALITY EXAMINATION REPORT PAPER NO.',
            'mailing_date' => 'FORMALITY EXAMINATION REPORT MAILING DATE',
            'publication_date' => 'PUBLICATION DATE',
            'issuance_date' => 'ISSUANCE DATE',
            'allowance_remarks' => 'ALLOWANCE REMARKS',
            'total_government_fees' => 'TOTAL GOVERNMENT FEES',
            'total_professional_fees' => 'TOTAL PROFESSIONAL FEES',
        ])->download('applications.csv');
    }
}
