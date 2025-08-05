<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PawnData;
use App\Models\PawnInterestData;

class ReportsController extends Controller
{
    public function OverviewReport()
    {
        $data = array(
            array(446,257,359,254,92),
            array(546, 457, 559, 544, 162),
            array(46, 57, 59, 54, 6),
            array(136, 57, 259, 54, 32)

        );
        return view ('backend.reports.overview_report',compact('data'));
    }

    public function PawnReport()
    {
        $data = array(446,257,359,254,92);
        $pawn_data = PawnData::take(20)->get();
        return view ('backend.reports.pawn_report',compact('data','pawn_data'));
    }

    public function SendInterestReport(){
        $data = array(546, 457, 559, 544, 162);
        return view ('backend.reports.send_interest_report',compact('data'));
    }

    public function IncreasePrincipleReport(){
        $data = array(46, 57, 59, 54, 6);
        return view ('backend.reports.increase_principle_report',compact('data'));
    }

    public function DecreasePrincipleReport(){
        $data = array(136, 57, 259, 54, 32);
        return view ('backend.reports.decrease_principle_report',compact('data'));
    }

    public function OutstandingInterestReport(){
        $data = array(46, 157, 259, 144, 62);
        return view ('backend.reports.outstanding_interest_report',compact('data'));
    }


}
