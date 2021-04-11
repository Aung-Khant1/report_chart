<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmstitleoperatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::select(DB::raw("select sms_title, operator, sum(sms_count) as total,counted_date as date from report_by_sms_title_operators group by counted_date,sms_title, operator order by counted_date desc"));

        // dd($data);
        return view('smstitleoperators.table',compact('data'));
    }

    public function smstitleoperatorsrefresh()
    {
        $data = DB::select(DB::raw("select sms_title, operator, sum(sms_count) as total,counted_date as date from report_by_sms_title_operators group by counted_date,sms_title, operator order by counted_date desc"));
        
        return $data;
    }
}
