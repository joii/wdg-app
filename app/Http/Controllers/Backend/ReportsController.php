<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PawnData;
use App\Models\PawnOnlineTransaction;
use App\Models\PawnInterestData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function OverviewReport()
    {

       $currentYear = Carbon::now()->year;
       $report = PawnOnlineTransaction::select(
        DB::raw('MONTH(created_at) as month'),
        'transaction_type',
        DB::raw('SUM(interest) as total_interest'),
        DB::raw('SUM(amount) as total_amount'),
        DB::raw('count(*) as total_item_count'),
        )
        ->whereYear('created_at', $currentYear)
        ->groupBy(DB::raw('MONTH(created_at)'), 'transaction_type')
        ->orderBy(DB::raw('MONTH(created_at)'))
        ->get();


        $data = array();
        $data1 = array();
        $data2 = array();
        $intr_arr = array();
        $acc_arr = array();
        $inc_arr = array();
        $dec_arr = array();
        $intr_count = array();
        $acc_count = array();
        $inc_count = array();
        $dec_count = array();

        for($i=0; $i<12; $i++){
                $intr_arr[$i] =0;
                $acc_arr[$i] =0;
                $inc_arr[$i]=0;
                $dec_arr[$i] =0;

                $intr_count[$i] =0;
                $acc_count[$i] =0;
                $inc_count[$i]=0;
                $dec_count[$i] =0;

            foreach($report as $r){

                if($r->month == $i+1 && $r->transaction_type == 'intr'){
                    $intr_arr[$i] = $r->total_interest;
                    $intr_count[$i] = $r->total_item_count;
                }
                if($r->month == $i+1 && $r->transaction_type == 'acc'){
                    $acc_arr[$i] = $r->total_interest;
                    $acc_count[$i] = $r->total_item_count;
                }

                if($r->month == $i+1 && $r->transaction_type == 'inc'){
                    $inc_arr[$i] = $r->total_amount;
                    $inc_count[$i] = $r->total_item_count;
                }

                if($r->month == $i+1 && $r->transaction_type == 'dec'){
                    $dec_arr[$i] = $r->total_amount;
                    $dec_count[$i] = $r->total_item_count;
                }


            }


            $data1 = array($intr_arr,$acc_arr,$inc_arr,$dec_arr);
            $data2 = array($intr_count,$acc_count,$inc_count,$dec_count);


        }

         $data = array($data1,$data2);





        return view ('backend.reports.overview_report',compact('data'));
    }

    public function PawnReport()
    {
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek(); // วันจันทร์ของสัปดาห์ที่แล้ว
        $endOfLastWeek   = Carbon::now()->subWeek()->endOfWeek();   // วันอาทิตย์ของสัปดาห์ที่แล้ว

        $pawn_data = DB::table('pawn_data')
            ->whereBetween('pawn_date', [$startOfLastWeek, $endOfLastWeek])
            ->orderBy('pawn_date', 'desc')
            ->get();

        $currentYear = Carbon::now()->year;

        $report = PawnData::select(
        DB::raw('MONTH(pawn_date) as month'),
        DB::raw('SUM(total_pawn_amount_first) as total_pawn_amount'),
        DB::raw('COUNT(*) as total_records')
        )
        ->whereYear('pawn_date', $currentYear)
        ->groupBy(DB::raw('MONTH(pawn_date)'))
        ->orderBy(DB::raw('MONTH(pawn_date)'))
        ->get();

        $data = array();
        $data1 = array();
        $data2 = array();
           for($i=0; $i<12; $i++){
             $data1[$i] =0;
             $data2[$i] =0;

            foreach($report as $r){
                if($r->month == $i+1){
                    $data1[$i] = $r->total_pawn_amount;
                    $data2[$i] = $r->total_records;
                }
            }
        }


        $data = array($data1,$data2);
        return view ('backend.reports.pawn_report',compact('data','pawn_data','startOfLastWeek','endOfLastWeek'));
    }

     public function PawnCustomReport(Request $request)
    {
        $date_filter = $request->date_filter;
        $startOfLastWeek = substr($date_filter, 0, 10);
        $endOfLastWeek   = substr($date_filter, -10);

        $pawn_data = DB::table('pawn_data')
            ->whereBetween('pawn_date', [$startOfLastWeek, $endOfLastWeek])
            ->orderBy('pawn_date', 'desc')
            ->get();

        $currentYear = Carbon::now()->year;

        $report = PawnData::select(
        DB::raw('MONTH(pawn_date) as month'),
        DB::raw('SUM(total_pawn_amount_first) as total_pawn_amount'),
        )
        ->whereYear('pawn_date', $currentYear)
        ->groupBy(DB::raw('MONTH(pawn_date)'))
        ->orderBy(DB::raw('MONTH(pawn_date)'))
        ->get();

         $data = array();
           for($i=0; $i<12; $i++){
             $data[$i] =0;

            foreach($report as $r){
                if($r->month == $i+1){
                    $data[$i] = $r->total_pawn_amount;
                }
            }
        }



        return view ('backend.reports.pawn_report',compact('data','pawn_data','startOfLastWeek','endOfLastWeek'));
    }

    public function SendInterestReport(){

        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek(); // วันจันทร์ของสัปดาห์ที่แล้ว
        $endOfLastWeek   = Carbon::now()->subWeek()->endOfWeek();   // วันอาทิตย์ของสัปดาห์ที่แล้ว

        $transactions = DB::table('pawn_online_transactions')
            ->where('transaction_type','intr')
            ->whereBetween('transaction_date', [$startOfLastWeek, $endOfLastWeek])
            ->orderBy('transaction_date', 'desc')
            ->get();
        $currentYear = Carbon::now()->year;
        $currentYear = Carbon::now()->year;

        $report = PawnOnlineTransaction::select(
        DB::raw('MONTH(transaction_date) as month'),
        DB::raw('SUM(interest) as total_interest'),
        DB::raw('COUNT(*) as total_records')
        )
        ->whereYear('transaction_date', $currentYear)
        ->where('transaction_type','intr')
        ->groupBy(DB::raw('MONTH(transaction_date)'))
        ->orderBy(DB::raw('MONTH(transaction_date)'))
        ->get();

         $data = array();
         $data1 = array();
         $data2 = array();
           for($i=0; $i<12; $i++){
             $data1[$i] =0;
             $data2[$i] =0;

            foreach($report as $r){
                if($r->month == $i+1){
                    $data1[$i] = $r->total_interest;
                    $data2[$i] = $r->total_records;
                }
            }
        }

        $data = array($data1,$data2); //
        return view ('backend.reports.send_interest_report',compact('data','transactions','startOfLastWeek','endOfLastWeek' ));
    }

     public function SendInterestCustomReport(Request $request){

        $date_filter = $request->date_filter;
        $startOfLastWeek = substr($date_filter, 0, 10);
        $endOfLastWeek   = substr($date_filter, -10);

        $transactions = DB::table('pawn_online_transactions')
            ->where('transaction_type','intr')
            ->whereBetween('transaction_date', [$startOfLastWeek, $endOfLastWeek])
            ->orderBy('transaction_date', 'desc')
            ->get();
        $currentYear = Carbon::now()->year;
        $currentYear = Carbon::now()->year;

        $report = PawnOnlineTransaction::select(
        DB::raw('MONTH(transaction_date) as month'),
        DB::raw('SUM(interest) as total_interest'),
        DB::raw('COUNT(*) as total_records')
        )
        ->whereYear('transaction_date', $currentYear)
        ->where('transaction_type','intr')
        ->groupBy(DB::raw('MONTH(transaction_date)'))
        ->orderBy(DB::raw('MONTH(transaction_date)'))
        ->get();

         $data = array();
         $data1 = array();
         $data2 = array();
           for($i=0; $i<12; $i++){
             $data1[$i] =0;
             $data2[$i] =0;

            foreach($report as $r){
                if($r->month == $i+1){
                    $data1[$i] = $r->total_interest;
                    $data2[$i] = $r->total_records;
                }
            }
        }

        $data = array($data1,$data2);

        return view ('backend.reports.send_interest_report',compact('data','transactions','startOfLastWeek','endOfLastWeek' ));
    }

    public function IncreasePrincipleReport(){
        //$transactions = PawnOnlineTransaction::where('transaction_type','inc')->take(20)->get();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek(); // วันจันทร์ของสัปดาห์ที่แล้ว
        $endOfLastWeek   = Carbon::now()->subWeek()->endOfWeek();   // วันอาทิตย์ของสัปดาห์ที่แล้ว

        $transactions = DB::table('pawn_online_transactions')
            ->where('transaction_type','inc')
            ->whereBetween('transaction_date', [$startOfLastWeek, $endOfLastWeek])
            ->orderBy('transaction_date', 'desc')
            ->get();
        $currentYear = Carbon::now()->year;

        $report = PawnOnlineTransaction::select(
        DB::raw('MONTH(transaction_date) as month'),
        DB::raw('SUM(interest) as total_interest'),
        DB::raw('COUNT(*) as total_records')
        )
        ->whereYear('transaction_date', $currentYear)
        ->where('transaction_type','inc')
        ->groupBy(DB::raw('MONTH(transaction_date)'))
        ->orderBy(DB::raw('MONTH(transaction_date)'))
        ->get();

         $data = array();
         $data1 = array();
         $data2 = array();
           for($i=0; $i<12; $i++){
             $data1[$i] =0;
             $data2[$i] =0;

            foreach($report as $r){
                if($r->month == $i+1){
                    $data1[$i] = $r->total_interest;
                    $data2[$i] = $r->total_records;
                }
            }
        }


        $data = array($data1,$data2);
        return view ('backend.reports.increase_principle_report',compact('data','transactions','startOfLastWeek','endOfLastWeek'));
    }

     public function IncreaseCustomReport(Request $request){
        $date_filter = $request->date_filter;
        $startOfLastWeek = substr($date_filter, 0, 10);
        $endOfLastWeek   = substr($date_filter, -10);

        $transactions = DB::table('pawn_online_transactions')
            ->where('transaction_type','inc')
            ->whereBetween('transaction_date', [$startOfLastWeek, $endOfLastWeek])
            ->orderBy('transaction_date', 'desc')
            ->get();
        $currentYear = Carbon::now()->year;

        $report = PawnOnlineTransaction::select(
        DB::raw('MONTH(transaction_date) as month'),
        DB::raw('SUM(interest) as total_interest'),
        DB::raw('COUNT(*) as total_records')
        )
        ->whereYear('transaction_date', $currentYear)
        ->where('transaction_type','inc')
        ->groupBy(DB::raw('MONTH(transaction_date)'))
        ->orderBy(DB::raw('MONTH(transaction_date)'))
        ->get();

          $data = array();
         $data1 = array();
         $data2 = array();
           for($i=0; $i<12; $i++){
             $data1[$i] =0;
             $data2[$i] =0;

            foreach($report as $r){
                if($r->month == $i+1){
                    $data1[$i] = $r->total_interest;
                    $data2[$i] = $r->total_records;
                }
            }
        }


        $data = array($data1,$data2);
        return view ('backend.reports.increase_principle_report',compact('data','transactions','startOfLastWeek','endOfLastWeek'));
    }

    public function DecreasePrincipleReport(){
       // $transactions = PawnOnlineTransaction::where('transaction_type','dec')->take(20)->get();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek(); // วันจันทร์ของสัปดาห์ที่แล้ว
        $endOfLastWeek   = Carbon::now()->subWeek()->endOfWeek();   // วันอาทิตย์ของสัปดาห์ที่แล้ว

        $transactions = DB::table('pawn_online_transactions')
            ->where('transaction_type','dec')
            ->whereBetween('transaction_date', [$startOfLastWeek, $endOfLastWeek])
            ->orderBy('transaction_date', 'desc')
            ->get();

        $currentYear = Carbon::now()->year;

        $report = PawnOnlineTransaction::select(
        DB::raw('MONTH(transaction_date) as month'),
        DB::raw('SUM(interest) as total_interest'),
        DB::raw('COUNT(*) as total_records')
        )
        ->whereYear('transaction_date', $currentYear)
        ->where('transaction_type','dec')
        ->groupBy(DB::raw('MONTH(transaction_date)'))
        ->orderBy(DB::raw('MONTH(transaction_date)'))
        ->get();

         $data = array();
         $data1 = array();
         $data2 = array();
           for($i=0; $i<12; $i++){
             $data1[$i] =0;
             $data2[$i] =0;

            foreach($report as $r){
                if($r->month == $i+1){
                    $data1[$i] = $r->total_interest;
                    $data2[$i] = $r->total_records;
                }
            }
        }

        $data = array($data1,$data2);
        return view ('backend.reports.decrease_principle_report',compact('data','transactions','startOfLastWeek','endOfLastWeek'));
    }

     public function DecreaseCustomReport(Request $request){
       // $transactions = PawnOnlineTransaction::where('transaction_type','dec')->take(20)->get();
        $date_filter = $request->date_filter;
        $startOfLastWeek = substr($date_filter, 0, 10);
        $endOfLastWeek   = substr($date_filter, -10);

        $transactions = DB::table('pawn_online_transactions')
            ->where('transaction_type','dec')
            ->whereBetween('transaction_date', [$startOfLastWeek, $endOfLastWeek])
            ->orderBy('transaction_date', 'desc')
            ->get();

        $currentYear = Carbon::now()->year;

        $report = PawnOnlineTransaction::select(
        DB::raw('MONTH(transaction_date) as month'),
        DB::raw('SUM(interest) as total_interest'),
        DB::raw('COUNT(*) as total_records')
        )
        ->whereYear('transaction_date', $currentYear)
        ->where('transaction_type','dec')
        ->groupBy(DB::raw('MONTH(transaction_date)'))
        ->orderBy(DB::raw('MONTH(transaction_date)'))
        ->get();

         $data = array();
         $data1 = array();
         $data2 = array();
           for($i=0; $i<12; $i++){
             $data1[$i] =0;
             $data2[$i] =0;

            foreach($report as $r){
                if($r->month == $i+1){
                    $data1[$i] = $r->total_interest;
                    $data2[$i] = $r->total_records;
                }
            }
        }

        $data = array($data1,$data2);
        return view ('backend.reports.decrease_principle_report',compact('data','transactions','startOfLastWeek','endOfLastWeek'));
    }

    public function OutstandingInterestReport(){
       // $transactions = PawnOnlineTransaction::where('transaction_type','acc')->take(20)->get();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek(); // วันจันทร์ของสัปดาห์ที่แล้ว
        $endOfLastWeek   = Carbon::now()->subWeek()->endOfWeek();   // วันอาทิตย์ของสัปดาห์ที่แล้ว

        $transactions = DB::table('pawn_online_transactions')
            ->where('transaction_type','acc')
            ->whereBetween('transaction_date', [$startOfLastWeek, $endOfLastWeek])
            ->orderBy('transaction_date', 'desc')
            ->get();
        $currentYear = Carbon::now()->year;
        $currentYear = Carbon::now()->year;

        $currentYear = Carbon::now()->year;

        $report = PawnOnlineTransaction::select(
        DB::raw('MONTH(transaction_date) as month'),
        DB::raw('SUM(interest) as total_interest'),
        DB::raw('COUNT(*) as total_records')
        )
        ->whereYear('transaction_date', $currentYear)
        ->where('transaction_type','acc')
        ->groupBy(DB::raw('MONTH(transaction_date)'))
        ->orderBy(DB::raw('MONTH(transaction_date)'))
        ->get();

         $data = array();
         $data1 = array();
         $data2 = array();
           for($i=0; $i<12; $i++){
             $data1[$i] =0;
             $data2[$i] =0;

            foreach($report as $r){
                if($r->month == $i+1){
                    $data1[$i] = $r->total_interest;
                    $data2[$i] = $r->total_records;
                }
            }
        }

        $data = array($data1,$data2);
        return view ('backend.reports.outstanding_interest_report',compact('data','transactions','startOfLastWeek','endOfLastWeek' ));
    }

   public function OutstandingInterestCustomReport(Request $request){
        $date_filter = $request->date_filter;
        $startOfLastWeek = substr($date_filter, 0, 10);
        $endOfLastWeek   = substr($date_filter, -10);

        $transactions = DB::table('pawn_online_transactions')
            ->where('transaction_type','acc')
            ->whereBetween('transaction_date', [$startOfLastWeek, $endOfLastWeek])
            ->orderBy('transaction_date', 'desc')
            ->get();
        $currentYear = Carbon::now()->year;
        $currentYear = Carbon::now()->year;

        $currentYear = Carbon::now()->year;

        $report = PawnOnlineTransaction::select(
        DB::raw('MONTH(transaction_date) as month'),
        DB::raw('SUM(interest) as total_interest'),
         DB::raw('COUNT(*) as total_records')
        )
        ->whereYear('transaction_date', $currentYear)
        ->where('transaction_type','acc')
        ->groupBy(DB::raw('MONTH(transaction_date)'))
        ->orderBy(DB::raw('MONTH(transaction_date)'))
        ->get();

         $data = array();
         $data1 = array();
         $data2 = array();
           for($i=0; $i<12; $i++){
             $data1[$i] =0;
             $data2[$i] =0;

            foreach($report as $r){
                if($r->month == $i+1){
                    $data1[$i] = $r->total_interest;
                    $data2[$i] = $r->total_records;
                }
            }
        }

        $data = array($data1,$data2);

        return view ('backend.reports.outstanding_interest_report',compact('data','transactions','startOfLastWeek','endOfLastWeek' ));
    }





}
