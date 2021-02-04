<?php

namespace App\Http\Controllers;

use App\Models\SmsApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SmsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // start daily report
       $yesterdayraw = DB::table('report_by_sms_apis')
                        ->where('counted_date',Carbon::yesterday())
                        ->get();
        $yesterdaylabel = [];
        $yesterdaydata = [];
        foreach ($yesterdayraw as $key => $value) {
            array_push($yesterdaylabel,$value->sms_api);
            array_push($yesterdaydata,$value->mobile_terminal_count);
        }
        
        $yesterday = new SmsApi();
        $yesterday->label = $yesterdaylabel;
        $yesterday->data = $yesterdaydata;
       
       // end daily report

       // start yearly report
        $thisyears = (int)Carbon::now()->format('Y');
        $thisyearraw = DB::table('report_by_sms_apis')
                        ->select(DB::raw("sum(mobile_terminal_count) as total, sms_api"))
                        ->whereBetween('counted_date',[$thisyears."-01-01",$thisyears."-12-31"])
                        ->groupBy('sms_api')
                        ->get();
        
        $thisyearlabel = [];
        $thisyeardata = [];
        foreach ($thisyearraw as $key => $value) {
            array_push($thisyearlabel,$value->sms_api);
            array_push($thisyeardata,$value->total);
        }
                        
        $thisyear = new SmsApi();
        $thisyear->label = $thisyearlabel;
        $thisyear->data = $thisyeardata;

        
       //end yearly report

       // start monthly report
    
        $thisyearstartdate = $thisyears.'-01-01';
        $thisyearenddate = $thisyears.'-12-31';
        $monthlyraw = DB::select(DB::raw("select month(counted_date) as counted_date,sms_api,sum(mobile_terminal_count) as total from report_by_sms_apis where counted_date between '".$thisyearstartdate."' and '".$thisyearenddate."' group by month(counted_date), sms_api"));
        
        $monthlyreportpermonthtelenordirect = [];
        $monthlyreportpermonthotherapis = [];
        $monthlyreportpermonthotherapislabel = [];
        
        foreach ($monthlyraw as $key => $value) {
            if ($key%2) {
                array_push($monthlyreportpermonthtelenordirect,$value);
                $dateObj   = Carbon::createFromFormat('!m', $value->counted_date);
                $monthName = $dateObj->format('F');
                array_push($monthlyreportpermonthotherapislabel,$monthName);
            }else{
                array_push($monthlyreportpermonthotherapis,$value);
            }
            
        }
        // dd($monthlyreportpermonthotherapislabel);
         // end monthly report

         // start weekly report (for last 10 days)
        $lastsevenday = date('Y-m-d', strtotime('-10 days'));
        $todaydate = date("Y-m-d");
        $fordailyreportraw = DB::table('report_by_sms_apis')
                            ->whereBetween('counted_date',[$lastsevenday,$todaydate])
                            ->get();
        $dailyreporttelenordirect = [];
        $dailyreportotherapi = [];
        foreach ($fordailyreportraw as $key => $value) {
            if ($key%2) {
                array_push($dailyreporttelenordirect,$value);
            }else{
                array_push($dailyreportotherapi,$value);
            }
        }

         // end weekly report (for last 7 days)

        return view('smsapis.chart', compact('yesterday', 'thisyear','monthlyreportpermonthtelenordirect','monthlyreportpermonthotherapis', 'dailyreporttelenordirect','dailyreportotherapi', 'monthlyreportpermonthotherapislabel'));
    }

   public function ysearch(Request $request)
   {
       
       $searchyear = DB::table('report_by_sms_apis')
                        ->select(DB::raw("sum(mobile_terminal_count) as total, sms_api"))
                        ->whereBetween('counted_date',[$request->searchdate."-01-01",$request->searchdate."-12-31"])
                        ->groupBy('sms_api')
                        ->get();
        
        $searchyearlabel = [];
        $searchyeardata = [];
        foreach ($searchyear as $key => $value) {
            array_push($searchyearlabel,$value->sms_api);
            array_push($searchyeardata,$value->total);
        }
                        
        $searchyear = new SmsApi();
        $searchyear->label = $searchyearlabel;
        $searchyear->data = $searchyeardata;

        // monthly start
        $searchthisyearstartdate = $request->searchdate.'-01-01';
        $searchthisyearenddate = $request->searchdate.'-12-31';
        $searchmonthlyraw = DB::select(DB::raw("select month(counted_date) as counted_date,sms_api,sum(mobile_terminal_count) as total from report_by_sms_apis where counted_date between '".$searchthisyearstartdate."' and '".$searchthisyearenddate."' group by month(counted_date), sms_api"));
        
        $searchmonthlyreportpermonthtelenordirect = [];
        $searchmonthlyreportpermonthotherapis = [];
        $searchmonthlyreportpermonthotherapislabel = [];
        
        foreach ($searchmonthlyraw as $key => $value) {
            if ($key%2) {
                array_push($searchmonthlyreportpermonthtelenordirect,$value);
                $dateObj   = Carbon::createFromFormat('!m', $value->counted_date);
                $monthName = $dateObj->format('F');
                array_push($searchmonthlyreportpermonthotherapislabel,$monthName);
            }else{
                array_push($searchmonthlyreportpermonthotherapis,$value);
            }
            
        }
        $searchmonthly = new SmsApi();
        $searchmonthly->label = $searchmonthlyreportpermonthotherapislabel;
        $searchmonthly->telenor = $searchmonthlyreportpermonthtelenordirect;
        $searchmonthly->other = $searchmonthlyreportpermonthotherapis;

        $searchthisyear = new SmsApi();
        $searchthisyear->searchyear = $searchyear;
        $searchthisyear->searchmonthly = $searchmonthly;

        return $searchthisyear;
   }
    
    
//    public function msearch(Request $request)
//    {
//     $searchthisyearstartdate = $request->msdate1;
//     $searchthisyearenddate = $request->msdate2;

//     $searchmonthlyraw = DB::select(DB::raw("select month(counted_date) as counted_date,sms_api,sum(mobile_terminal_count) as total from report_by_sms_apis where counted_date between '".$searchthisyearstartdate."' and '".$searchthisyearenddate."' group by month(counted_date), sms_api"));
    
//     $searchmonthlyreportpermonthtelenordirect = [];
//     $searchmonthlyreportpermonthotherapis = [];
//     $searchmonthlyreportpermonthotherapislabel = [];
    
//     foreach ($searchmonthlyraw as $key => $value) {
//         if ($key%2) {
//             array_push($searchmonthlyreportpermonthtelenordirect,$value);
//             $dateObj   = Carbon::createFromFormat('!m', $value->counted_date);
//             $monthName = $dateObj->format('F');
//             array_push($searchmonthlyreportpermonthotherapislabel,$monthName);
//         }else{
//             array_push($searchmonthlyreportpermonthotherapis,$value);
//         }
        
//     }

//     $searchmonthlyreport = new SmsApi();
//     $searchmonthlyreport->lables = $searchmonthlyreportpermonthotherapislabel;
//     $searchmonthlyreport->telenordirect = $searchmonthlyreportpermonthtelenordirect;
//     $searchmonthlyreport->otherapi = $searchmonthlyreportpermonthotherapis;
//     return $searchmonthlyreport;

//    }
    
    
    
}
