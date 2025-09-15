<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PawnAddData;
use App\Models\PawnData;
use App\Models\PawnInterestData;
use App\Models\PawnOnlineTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class PawnOnlineTransactionController extends Controller
{
    public function InterestTransactionList(){
        //$pawn_data = PawnOnlineTransaction::all()->orderBy('id', 'desc');
        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','intr')
         ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.interest.index',compact('pawn_data'));
    }

    public function CustomInterestTransaction(Request $request){
        $date_filter = $request->date_filter;
        $startDate = substr($date_filter, 0, 10);
        $endDate   = substr($date_filter, -10);
        $selectedStartDate = Carbon::parse($startDate);
        $selectedEndDate = Carbon::parse($endDate);

        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','intr')
        ->whereBetween('pawn_online_transactions.transaction_date', [
                $selectedStartDate->copy()->startOfDay(),       // 00:00:00
                $selectedEndDate->copy()->setTime(11, 59, 59) // 11:59:59
            ])
         ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.interest.index',compact('pawn_data'));
    }



      public function InterestTransactionContract(String $pawn_barcode){

        $transaction_data = PawnOnlineTransaction::where('pawn_barcode', $pawn_barcode)->where('transaction_type','intr')->first();
        $pawn_barcode = $transaction_data->pawn_barcode;
        $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();
        return view('backend.pawn_online_transaction.interest.contract',compact('data','transaction_data'));
     }

    public function InterestTransactionPrint(String $pawn_barcode){

        $transaction_data = PawnOnlineTransaction::where('pawn_barcode', $pawn_barcode)->first();
        $interest_data = PawnInterestData::where('pawn_barcode', $pawn_barcode)->first();
        $pawn_barcode = $transaction_data->pawn_barcode;
        $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();

        return view('backend.pawn_online_transaction.interest.print',compact('data','interest_data','transaction_data'));
     }

     public function InterestTransactionEdit(String $token_id){

        $transaction_data = PawnOnlineTransaction::where('token_id', $token_id)->first();
        $pawn_barcode = $transaction_data->pawn_barcode;
        $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();
        $interest_data = PawnInterestData::where('id',$transaction_data->pawn_id)->first();
        return view('backend.pawn_online_transaction.interest.edit',compact('data','interest_data','transaction_data'));
    }

    public function InterestTransactionUpdate(Request $request){
        $id = $request->id;
        $data = PawnOnlineTransaction::findOrFail($id);
        $data->payment_status = $request->status;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return back()->withInput()->with('notification');
    }

    public function InterestCustomerTransactionList(String $id_card, String $customer_phone){

        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','intr')
        ->where('pawn_data.customer_phone', $customer_phone)
        ->orWhere('pawn_data.id_card', $id_card)
        ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.interest.index',compact('pawn_data'));
    }


    //Accrued

     public function AccruedInterestTransactionList(){
        //$pawn_data = PawnOnlineTransaction::all()->orderBy('id', 'desc');
        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','acc')
         ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.accrued_interest.index',compact('pawn_data'));
    }


    public function CustomAccruedInterestTransaction(Request $request){
        $date_filter = $request->date_filter;
        $startDate = substr($date_filter, 0, 10);
        $endDate   = substr($date_filter, -10);
        $selectedStartDate = Carbon::parse($startDate);
        $selectedEndDate = Carbon::parse($endDate);

        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','acc')
        ->whereBetween('pawn_online_transactions.transaction_date', [
                $selectedStartDate->copy()->startOfDay(),       // 00:00:00
                $selectedEndDate->copy()->setTime(11, 59, 59) // 11:59:59
            ])
        ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

         return view('backend.pawn_online_transaction.accrued_interest.index',compact('pawn_data'));
    }

     public function AccruedInterestTransactionContract(String $pawn_barcode){

         $transaction_data = PawnOnlineTransaction::where('pawn_barcode', $pawn_barcode)->where('transaction_type','acc')->first();
         $transaction_id = $transaction_data->id;
         $transaction_parties_data = PawnOnlineTransaction::where('transaction_parties', $transaction_id)->first();

         $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();
        return view('backend.pawn_online_transaction.accrued_interest.contract',compact('data','transaction_data','transaction_parties_data'));
     }

     public function AccruedInterestTransactionPrint(String $pawn_barcode){

        $transaction_data = PawnOnlineTransaction::where('pawn_barcode', $pawn_barcode)->first();
        $interest_data = PawnInterestData::where('pawn_barcode', $pawn_barcode)->first();
       $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();

        return view('backend.pawn_online_transaction.accrued_interest.print',compact('data','interest_data','transaction_data'));
     }


      public function AccruedInterestTransactionEdit(String $token_id){

        $transaction_data = PawnOnlineTransaction::where('token_id', $token_id)->first();
        $pawn_barcode = $transaction_data->pawn_barcode;
        $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();

        return view('backend.pawn_online_transaction.accrued_interest.edit',compact('data','transaction_data'));
    }

    public function AccruedInterestTransactionUpdate(Request $request){
        $id = $request->id;
        $data = PawnOnlineTransaction::findOrFail($id);
        $data->payment_status = $request->status;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return back()->withInput()->with('notification');
    }

    public function AccruedInterestCustomerTransactionList(String $id_card, String $customer_phone){
        //$pawn_data = PawnOnlineTransaction::all()->orderBy('id', 'desc');
        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','acc')
        ->where('pawn_data.customer_phone', $customer_phone)
        ->orWhere('pawn_data.id_card', $id_card)
        ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.accrued_interest.index',compact('pawn_data'));
    }


    //Increase

     public function IncreasePrincipleTransactionList(){
       $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','inc')
        ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.increase_principle.index',compact('pawn_data'));
    }

    public function CustomIncreaseTransaction(Request $request){
        $date_filter = $request->date_filter;
        $startDate = substr($date_filter, 0, 10);
        $endDate   = substr($date_filter, -10);
        $selectedStartDate = Carbon::parse($startDate);
        $selectedEndDate = Carbon::parse($endDate);

        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','inc')
        ->whereBetween('pawn_online_transactions.transaction_date', [
                $selectedStartDate->copy()->startOfDay(),       // 00:00:00
                $selectedEndDate->copy()->setTime(11, 59, 59) // 11:59:59
            ])
        ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.increase_principle.index',compact('pawn_data'));
    }




    public function IncreasePrincipleTransactionContract(String $pawn_barcode){

         $transaction_data = PawnOnlineTransaction::where('pawn_barcode', $pawn_barcode)
         ->where('transaction_type', 'inc')
         ->first();
         $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();
        return view('backend.pawn_online_transaction.increase_principle.contract',compact('data','transaction_data'));
     }

      public function IncreasePrincipleTransactionPrint(String $pawn_barcode){

        $transaction_data = PawnOnlineTransaction::where('pawn_barcode', $pawn_barcode)->where('transaction_type', 'inc')->first();
        $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();

        return view('backend.pawn_online_transaction.increase_principle.print',compact('data','transaction_data'));
     }

     public function IncreasePrincipleTransactionEdit(String $token_id){

        $transaction_data = PawnOnlineTransaction::where('token_id', $token_id)->first();
        $pawn_barcode = $transaction_data->pawn_barcode;
        $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();

        return view('backend.pawn_online_transaction.increase_principle.edit',compact('data','transaction_data'));
    }

    public function IncreasePrincipleTransactionUpdate(Request $request){
        $id = $request->id;
        $data = PawnOnlineTransaction::findOrFail($id);
        $data->payment_status = $request->status;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return back()->withInput()->with('notification');
    }

    public function IncreaseCustomerTransactionList(String $id_card, String $customer_phone){
        //$pawn_data = PawnOnlineTransaction::all()->orderBy('id', 'desc');
        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','inc')
        ->where('pawn_data.customer_phone', $customer_phone)
        ->orWhere('pawn_data.id_card', $id_card)
        ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.increase_principle.index',compact('pawn_data'));
    }


    //Decrease

     public function DecreasePrincipleTransactionList(){
        //$pawn_data = PawnOnlineTransaction::all()->orderBy('id', 'desc');
        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','dec')
        ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.decrease_principle.index',compact('pawn_data'));
    }

        public function CustomDecreaseTransaction(Request $request){
        $date_filter = $request->date_filter;
        $startDate = substr($date_filter, 0, 10);
        $endDate   = substr($date_filter, -10);
        $selectedStartDate = Carbon::parse($startDate);
        $selectedEndDate = Carbon::parse($endDate);

        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','dec')
        ->whereBetween('pawn_online_transactions.transaction_date', [
                $selectedStartDate->copy()->startOfDay(),       // 00:00:00
                $selectedEndDate->copy()->setTime(11, 59, 59) // 11:59:59
            ])
        ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.decrease_principle.index',compact('pawn_data'));
    }


    public function DecreasePrincipleTransactionContract(String $pawn_barcode){

         $transaction_data = PawnOnlineTransaction::where('pawn_barcode', $pawn_barcode)->where('transaction_type', 'dec')->first();
         $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();
        return view('backend.pawn_online_transaction.decrease_principle.contract',compact('data','transaction_data'));
     }

      public function DecreasePrincipleTransactionPrint(String $pawn_barcode){

        $transaction_data = PawnOnlineTransaction::where('pawn_barcode', $pawn_barcode)->where('transaction_type', 'dec')->first();
        $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();

        return view('backend.pawn_online_transaction.decrease_principle.print',compact('data','transaction_data'));
     }

     public function DecreasePrincipleTransactionEdit(String $token_id){

        $transaction_data = PawnOnlineTransaction::where('token_id', $token_id)->first();
        $pawn_barcode = $transaction_data->pawn_barcode;
        $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();

        return view('backend.pawn_online_transaction.decrease_principle.edit',compact('data','transaction_data'));
    }

    public function DecreasePrincipleTransactionUpdate(Request $request){
        $id = $request->id;
        $data = PawnOnlineTransaction::findOrFail($id);
        $data->payment_status = $request->status;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return back()->withInput()->with('notification');
    }

    public function DecreaseCustomerTransactionList(String $id_card, String $customer_phone){
        //$pawn_data = PawnOnlineTransaction::all()->orderBy('id', 'desc');
        $pawn_data = DB::table('pawn_online_transactions')
        ->join('pawn_data', 'pawn_online_transactions.pawn_barcode', '=', 'pawn_data.pawn_barcode')
        ->where('pawn_online_transactions.transaction_type','=','dec')
        ->where('pawn_data.customer_phone', $customer_phone)
        ->orWhere('pawn_data.id_card', $id_card)
        ->orderBy('pawn_online_transactions.id', 'desc')
        ->get();

        return view('backend.pawn_online_transaction.decrease_principle.index',compact('pawn_data'));
    }

    public function CancelTransaction(Request $request){
        $data = PawnOnlineTransaction::findOrFail($request->id);
        $data->is_erased = TRUE; // Cancel transaction
        $data->erased_date = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $notification = array(
            'message' => 'ยกเลิกรายการสำเร็จ',
            'alert-type' => 'success'
        );

        return back()->withInput()->with('notification');

    }








}
