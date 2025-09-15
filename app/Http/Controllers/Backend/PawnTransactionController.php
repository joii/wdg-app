<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PawnAddData;
use Illuminate\Http\Request;
use App\Models\PawnData;
use App\Models\PawnInterestData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PawnTransactionController extends Controller
{
    public function Index(){

       // $pawn_data = PawnData::all();
         $startDate = Carbon::now()->subDays(90);
         $endDate = Carbon::now();
         $pawn_data = PawnData::whereBetween('pawn_date', [$startDate,$endDate])
            ->orderBy('pawn_date','desc')
            ->get();
        return view('backend.pawn_transaction.index',compact('pawn_data'));
    }

    public function CustomPawnTransaction(Request $request){

        $date_filter = $request->date_filter;
        $startDate = substr($date_filter, 0, 10);
        $endDate   = substr($date_filter, -10);


        $selectedStartDate = Carbon::parse($startDate);
        $selectedEndDate = Carbon::parse($endDate);

        $pawn_data = DB::table('pawn_data')
            ->whereBetween('pawn_date_cal_interest', [
                $selectedStartDate->copy()->startOfDay(),       // 00:00:00
                $selectedEndDate->copy()->setTime(11, 59, 59) // 11:59:59
            ])
            ->orderBy('pawn_date_cal_interest', 'desc')
            ->get();

        // $pawn_data = DB::table('pawn_data')
        //     ->whereBetween('pawn_date_cal_interest', [$startDate, $endDate])
        //     ->orderBy('pawn_date_cal_interest', 'desc')
        //     ->get();


        return view('backend.pawn_transaction.index',compact('pawn_data'));
    }

    public function Latest(){
        // Get today's date and find pawn data that was added today
       // $pawn_data = PawnData::where('pawn_date_cal_interest',Carbon::today())->get();
        //  $startDate = Carbon::now()->subDays(7);
        //  $endDate = Carbon::now();
        //  $pawn_data = PawnData::whereBetween('pawn_date', [$startDate,$endDate])
        //     ->orderBy('id','desc')
        //     ->get();

        $pawn_data = PawnData::orderBy('id', 'desc')
            ->take(100)
            ->get();
        return view('backend.pawn_transaction.latest',compact('pawn_data'));
    }

    public function Contract(String $id){
        $data = PawnData::find($id);
        //$pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
        $pawn_interest_data = PawnInterestData::where('pawn_barcode', $data->pawn_barcode)->take(6)->orderBy('created_at','desc')->get();
        return view('backend.pawn_transaction.contract',compact('data','pawn_interest_data'));
    }

     public function ContractOverdue(String $pawn_barcode){
        $data = PawnData::where('pawn_barcode',$pawn_barcode)->first();
        //print($data->pawn_id);
        //$pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
         $pawn_interest_data = PawnInterestData::where('pawn_barcode', $data->pawn_barcode)->take(6)->orderBy('created_at','desc')->get();
        return view('backend.pawn_transaction.contract',compact('data','pawn_interest_data'));
    }

    public function Print(String $id){
        $data = PawnData::find($id);
        $pawn_add_data = PawnAddData::where('pawn_id',$data->pawn_id)->get();
        //$pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
         $pawn_interest_data = PawnInterestData::where('pawn_barcode', $data->pawn_barcode)->take(6)->orderBy('created_at','desc')->get();
        return view('backend.pawn_transaction.print',compact('data','pawn_interest_data'));
    }

    public function Detail(String $id){
        $data = PawnData::find($id);
        $pawn_add_data = PawnAddData::where('pawn_id',$data->pawn_id)->get();
        //$pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
         $pawn_interest_data = PawnInterestData::where('pawn_barcode', $data->pawn_barcode)->take(6)->orderBy('created_at','desc')->get();
        return view('backend.pawn_transaction.detail',compact('data','pawn_interest_data'));
    }

    public function Edit(String $id){
        $data = PawnData::find($id);
        $pawn_add_data = PawnAddData::where('pawn_id',$data->pawn_id)->get();
        //$pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
         $pawn_interest_data = PawnInterestData::where('pawn_barcode', $data->pawn_barcode)->take(6)->orderBy('created_at','desc')->get();
        return view('backend.pawn_transaction.edit',compact('data','pawn_interest_data'));
    }

    public function Update(Request $request){
        $id = $request->id;
        $data = PawnData::findOrFail($id);
        $data->customer_name = $request->customer_name;
        $data->customer_address = $request->customer_address;
        $data->customer_phone = $request->customer_phone;
        $data->id_card = $request->id_card;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return back()->withInput()->with('notification');
    }

    public function Interest(String $id){
        //$data = PawnData::find($id);
        $data = PawnData::where('id',$id)->first();
        //$pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
         $pawn_interest_data = PawnInterestData::where('pawn_barcode', $data->pawn_barcode)->take(6)->orderBy('created_at','desc')->get();
        return view('backend.pawn_transaction.pawn_interest',compact('data','pawn_interest_data'));
    }
}
