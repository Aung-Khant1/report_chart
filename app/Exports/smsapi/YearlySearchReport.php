<?php

namespace App\Exports\smsapi;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class YearlySearchReport implements FromCollection
{
    protected $searchyeardate;

    public function __construct(array $searchyeardate) {
        $this->searchyeardate = $searchyeardate[0];
 }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $searchyeardate = $this->searchyeardate;
        $searchyearreport = DB::table('report_by_sms_apis')
                        ->select(DB::raw("sum(sms_count) as total, sms_api"))
                        ->whereBetween('counted_date',[$this->searchyeardate."-01-01",$this->searchyeardate."-12-31"])
                        ->groupBy('sms_api')
                        ->get();



        // $data = $this->searchyeardate;
        
        return $searchyearreport;
    }
}
