<?php

namespace App\Exports\smsapi;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class YearlyReport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $thisyears = (int)Carbon::now()->format('Y');
        $thisyearraw = DB::table('report_by_sms_apis')
                        ->select(DB::raw("sms_api, sum(sms_count) as total"))
                        ->whereBetween('counted_date',[$thisyears."-01-01",$thisyears."-12-31"])
                        ->groupBy('sms_api')
                        ->get();

        return $thisyearraw;
    }
}
