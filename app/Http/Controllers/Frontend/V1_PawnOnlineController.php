<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PawnAddData;
use App\Models\PawnData;
use App\Models\PawnSendInterestData;
use App\Models\PawnOnlineTransaction;
use App\Models\PawnTransaction;
use App\Models\PawnInterestData;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class PawnOnlineController extends Controller
{
    public function Index(){

    }

    public function PawnInterest($pawn_barcode){
       $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();
       $interest_data = PawnInterestData::where('pawn_barcode', $pawn_barcode)->get();
       return view('frontend.customer.pawn_interest', compact('pawn_data','interest_data'));

    }

    public function PayInterest(Request $request){
        $pawn_barcode = $request->pawn_barcode;
        $interest_amount = $request->interest_amount;

        $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();

          return view('frontend.customer.pay_interest', compact('pawn_data','interest_amount'));
    }

    public function StorePayInterest(Request $request){

         $pawn_id = $request->pawn_id;
         $pawn_barcode = $request->pawn_barcode;
         $transaction_type = $request->transaction_type;

          // จำนวนเงินที่โอน
         $payment_amount = $request->interest_amount;

         // pawn_interest_id
         $interest_data = PawnInterestData::where('pawn_barcode', $pawn_barcode)->where('interest',$payment_amount)->first();
         $pawn_interest_id = $interest_data->id;


         if ($request->file('fileInput')) {
            $image = $request->file('fileInput');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(800,1000)->save(public_path('uploads/payment/slip/'.$name_gen));
            $save_url = 'uploads/payment/slip/'.$name_gen;

            $transaction = PawnOnlineTransaction::create([
                'token_id' => Str::random(60),
                'transaction_date' => Carbon::now(),
                'transaction_time' => Carbon::now()->toTimeString(),
                'transaction_code' => Str::random(6),
                'transaction_type' => 'intr',//$request->transaction_type,
                'pawn_id' => $request->pawn_id,
                'pawn_barcode' => $request->pawn_barcode,
                'branch_id' => $request->branch_id,
                'member_id' => Auth::guard('member')->id(),
                'customer_id' => NULL,
                'interest' => 0,
                'amount' => 0,
                'payment_amount' => $payment_amount,
                'payment_method' => $request->payment_method,
                'payment_date' => $request->payment_date,
                'payment_slip' => $save_url,
                'payment_status' => $request->payment_status,
                'customer_name' => $request->customer_name,
                'customer_address' => $request->customer_address,
                'customer_phone' => $request->customer_phone,
                'status' => 'pending',
                'created_at' => Carbon::now(),
            ]);

            $transaction_id = $transaction->id;


        }


         // Update Pawn Transaction
            PawnTransaction::create([
                'pawn_id' => $pawn_id,
                'transaction_id' => $transaction_id,
                'transaction_type' => $transaction_type,
                'pawn_add_id' => NULL,
                'pawn_interest_id' =>  $pawn_interest_id,
                'pawn_outstanding_interest_id' => NULL,
                'yup_id' =>  NULL,
                'withdrawn_id' =>  NULL,
                'payment_status' =>'pending',
                'created_at' => Carbon::now(),
            ]);


       $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();

        $member_id = Auth::guard('member')->id();

        $transactions = PawnOnlineTransaction::where('member_id',$member_id)->latest()->paginate(10);
        return view('frontend.customer.transaction_history', compact('transactions'));
    }



    public function PawnAdd($pawn_barcode){
       $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();
       $pawn_add_data = PawnAddData::where('pawn_barcode', $pawn_barcode)->latest()->first();
       $pawn_send_data = PawnSendInterestData::where('pawn_barcode', $pawn_barcode)->latest()->first();
       $count_send_data = PawnsendInterestData::where('pawn_barcode', $pawn_barcode)->count();
       $pawn_send_id = $pawn_send_data->id;
       $count_paid_interest = PawnTransaction::where('pawn_outstanding_interest_id', $pawn_send_id)->where('payment_status', 'paid')->count();
       if($count_paid_interest>0){
        $count_send_data =0;
       }

       return view('frontend.customer.pawn_add', compact('pawn_data','pawn_add_data','pawn_send_data','count_send_data'));

    }

    public function PawnAddCheckOutstandingInterest(Request $request){
         $pawn_barcode = $request->barcode;

         $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();
         $pawn_add_data = PawnAddData::where('pawn_barcode', $pawn_barcode)->latest()->first();
         $pawn_send_data = PawnSendInterestData::where('pawn_barcode', $pawn_barcode)->latest()->first();
         $count_send_data = PawnsendInterestData::where('pawn_barcode', $pawn_barcode)->count();
         $pawn_send_id = $pawn_send_data->id;
         $count_paid_interest = PawnTransaction::where('pawn_outstanding_interest_id', $pawn_send_id)->where('payment_status', 'paid')->count();
         if($count_paid_interest>0){
            $count_send_data =0;
         }

         return view('frontend.customer.consignment_detail', compact('pawn_data','pawn_add_data','pawn_send_data','count_send_data'));

    }

    public function PayOutstandingInterest(Request $request){
        $pawn_barcode = $request->barcode;
        $customer_id = $request->customer_id;
        $add_amount = $request->add_amount;

        $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();
        $pawn_send_data = PawnSendInterestData::where('pawn_barcode', $pawn_barcode)->latest()->first();
        $count_send_data = PawnsendInterestData::where('pawn_barcode', $pawn_barcode)->count();
        $pawn_send_id = $pawn_send_data->id;
        $count_paid_interest = PawnTransaction::where('pawn_outstanding_interest_id', $pawn_send_id)->where('payment_status', 'paid')->count();
        if($count_paid_interest>0){
         $count_send_data =0;
        }

          return view('frontend.customer.outstanding_interest', compact('pawn_data','pawn_send_data','count_send_data','customer_id','add_amount'));

    }

    public function ConfirmPayOutstandingInterest(Request $request){
        $pawn_barcode = $request->pawn_barcode;
        $customer_id = $request->customer_id;
        $add_amount = $request->add_amount;

        $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();
        $pawn_send_data = PawnSendInterestData::where('pawn_barcode', $pawn_barcode)->latest()->first();
        $count_send_data = PawnsendInterestData::where('pawn_barcode', $pawn_barcode)->count();
        $pawn_send_id = $pawn_send_data->id;
       $count_paid_interest = PawnTransaction::where('pawn_outstanding_interest_id', $pawn_send_id)->where('payment_status', 'paid')->count();
       if($count_paid_interest>0){
        $count_send_data =0;
       }

          return view('frontend.customer.confirm_payment', compact('pawn_data','pawn_send_data','count_send_data','customer_id','add_amount'));
    }

     public function StorePayOutstandingInterest(Request $request){

         $pawn_id = $request->pawn_id;
         $pawn_barcode = $request->pawn_barcode;
         $transaction_type = $request->transaction_type;
         $pawn_send_interest_id = $request->pawn_send_interest_id;
         $add_amount = $request->add_amount;

         if ($request->file('fileInput')) {
            $image = $request->file('fileInput');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(800,1000)->save(public_path('uploads/payment/slip/'.$name_gen));
            $save_url = 'uploads/payment/slip/'.$name_gen;

            $transaction = PawnOnlineTransaction::create([
                'token_id' => Str::random(60),
                'transaction_date' => Carbon::now(),
                'transaction_time' => Carbon::now()->toTimeString(),
                'transaction_code' => Str::random(10),
                'transaction_type' => 'acc',//$request->transaction_type,
                'pawn_id' => $request->pawn_id,
                'pawn_barcode' => $request->pawn_barcode,
                'branch_id' => $request->branch_id,
                'member_id' => Auth::guard('member')->id(),
                'customer_id' => $request->customer_id,
                'interest' => $request->interest,
                'amount' => $request->total_pawn_amount,
                'payment_amount' => $request->interest,
                'payment_method' => $request->payment_method,
                'payment_date' => $request->payment_date,
                'payment_slip' => $save_url,
                'payment_status' => $request->payment_status,
                'customer_name' => $request->customer_name,
                'customer_address' => $request->customer_address,
                'customer_phone' => $request->customer_phone,
                'status' => 'pending',
                'created_at' => Carbon::now(),
            ]);

            $transaction_id = $transaction->id;


        }

        // $notification = array(
        //     'message' => 'บันทึกข้อมูลสำเร็จ',
        //     'alert-type' => 'success'
        // );

        //return redirect()->route('customer.transaction_history');

         // Update Pawn Transaction
            PawnTransaction::create([
                'pawn_id' => $pawn_id,
                'transaction_id' => $transaction_id,
                'transaction_type' => 'acc',//$transaction_type,
                'pawn_add_id' => NULL,
                'pawn_interest_id' =>  NULL,
                'pawn_outstanding_interest_id' => $pawn_send_interest_id,
                'yup_id' =>  NULL,
                'withdrawn_id' =>  NULL,
                'payment_status' =>'pending',
                'created_at' => Carbon::now(),
            ]);


       $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();
       $pawn_add_data = PawnAddData::where('pawn_barcode', $pawn_barcode)->latest()->first();
       $pawn_send_data = PawnSendInterestData::where('pawn_barcode', $pawn_barcode)->latest()->first();
       $count_send_data = PawnsendInterestData::where('pawn_barcode', $pawn_barcode)->count();

        return redirect()->route('customer.pawn_add',$pawn_barcode)->with('pawn_data','pawn_add_data','pawn_send_data','count_send_data','add_amount');


    }

    public function TransactionHistory(){
        $member_id = Auth::guard('member')->id();
        $transaction_type ='';

        $transactions = PawnOnlineTransaction::where('member_id',$member_id)->latest()->paginate(10);
        return view('frontend.customer.transaction_history', compact('transactions','transaction_type'));
    }


    public function FilterTransactionHistory($transaction_type){
        $member_id = Auth::guard('member')->id();

        $transactions = PawnOnlineTransaction::where('member_id',$member_id)->where('transaction_type',$transaction_type)->latest()->paginate(10);
        return view('frontend.customer.transaction_history', compact('transactions','transaction_type'));
    }


      public function ConfirmIncreasePrinciple(Request $request){
        $pawn_barcode = $request->barcode;
        $customer_id = $request->customer_id;
        $add_amount = $request->add_amount;

        $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();
        $pawn_send_data = PawnSendInterestData::where('pawn_barcode', $pawn_barcode)->latest()->first();
        $count_send_data = PawnsendInterestData::where('pawn_barcode', $pawn_barcode)->count();
        $pawn_send_id = $pawn_send_data->id;
        $count_paid_interest = PawnTransaction::where('pawn_outstanding_interest_id', $pawn_send_id)->where('payment_status', 'paid')->count();
        if($count_paid_interest>0){
         $count_send_data =0;
        }

          return view('frontend.customer.confirm_increase_principle', compact('pawn_data','pawn_send_data','count_send_data','customer_id','add_amount'));

    }

    public function IncreasePrinciple(Request $request){
         $pawn_id = $request->pawn_id;
         $pawn_barcode = $request->pawn_barcode;
         $pawn_send_interest_id = $request->pawn_send_interest_id;
         $add_amount = $request->add_amount;



         // Accrued Interest Transaction
         $transaction_type = 'acc';
         $transaction = PawnOnlineTransaction::create([
                'token_id' => Str::random(60),
                'transaction_date' => Carbon::now(),
                'transaction_time' => Carbon::now()->toTimeString(),
                'transaction_code' => Str::random(10),
                'transaction_type' => 'acc',//$request->transaction_type,
                'pawn_id' => $request->pawn_id,
                'pawn_barcode' => $request->pawn_barcode,
                'branch_id' => $request->branch_id,
                'member_id' => Auth::guard('member')->id(),
                'customer_id' => $request->customer_id,
                'interest' => $request->interest,
                'amount' => $request->total_pawn_amount,
                'payment_amount' => $request->interest,
                'payment_method' => $request->payment_method,
                'payment_date' => $request->payment_date,
                'payment_slip' => NULL,
                'payment_status' => 'paid',
                'customer_name' => $request->customer_name,
                'customer_address' => $request->customer_address,
                'customer_phone' => $request->customer_phone,
                'status' => 'paid',
                'created_at' => Carbon::now(),
            ]);

            $transaction_id = $transaction->id;

            // Update Pawn Transaction
            PawnTransaction::create([
                'pawn_id' => $pawn_id,
                'transaction_id' => $transaction_id,
                'transaction_type' => 'acc',//$transaction_type,
                'pawn_add_id' => NULL,
                'pawn_interest_id' =>  NULL,
                'pawn_outstanding_interest_id' => $pawn_send_interest_id,
                'yup_id' =>  NULL,
                'withdrawn_id' =>  NULL,
                'payment_status' =>'paid',
                'created_at' => Carbon::now(),
            ]);


         // Increase Pawn Amount Transaction
         $transaction_type = 'inc';
         $pawn_add_data = PawnAddData::where('pawn_barcode', $pawn_barcode)->latest()->first();
         $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();
         $pawn_add_id = $pawn_add_data->id;
         $pawn_id = $pawn_add_data->pawn_id;


       $transaction = PawnOnlineTransaction::create([
        'token_id' => Str::random(60),
        'transaction_date' => Carbon::now(),
        'transaction_time' => Carbon::now()->toTimeString(),
        'transaction_code' => Str::random(10),
        'transaction_parties' => $transaction_id,
        'transaction_type' => 'inc',
        'pawn_id' => $pawn_add_data->pawn_id,
        'pawn_barcode' => $pawn_add_data->pawn_barcode,
        'branch_id' => 1,
        'member_id' => Auth::guard('member')->id(),
        'customer_id' => $pawn_add_data->customer_id,
        'interest' => 0,
        'amount' => $pawn_data->total_pawn_amount,
        'payment_amount' => $request->add_amount,
        'payment_status' => 'pending',
        'customer_name' => $pawn_data->customer_name,
        'customer_address' => $pawn_data->customer_address,
        'customer_phone' => $pawn_data->customer_phone,
        'status' => 'pending',
        'created_at' => Carbon::now(),
         ]);

         $transaction_id = $transaction->id;


          // Update Pawn Transaction
            PawnTransaction::create([
                'pawn_id' => $pawn_id,
                'transaction_id' => $transaction_id,
                'transaction_type' => $transaction_type,
                'pawn_add_id' => $pawn_add_id,
                'pawn_interest_id' =>  NULL,
                'pawn_outstanding_interest_id' => NULL,
                'yup_id' =>  NULL,
                'withdrawn_id' =>  NULL,
                'payment_status' =>'pending',
                'created_at' => Carbon::now(),
            ]);

            $member_id = Auth::guard('member')->id();
            $transaction_type ='';
            $transactions = PawnOnlineTransaction::where('member_id',$member_id)->latest()->paginate(10);
            return view('frontend.customer.transaction_history', compact('transactions','transaction_type'));

    }


    public function PawnDecrease($pawn_barcode){
       $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();
       $pawn_interest_data = PawnInterestData::where('pawn_barcode', $pawn_barcode)->latest()->first();
       $pawn_send_data = PawnSendInterestData::where('pawn_barcode', $pawn_barcode)->latest()->first();
       $count_send_data = PawnsendInterestData::where('pawn_barcode', $pawn_barcode)->count();
       $pawn_send_id = $pawn_send_data->id;
       $count_paid_interest = PawnTransaction::where('pawn_outstanding_interest_id', $pawn_send_id)->where('payment_status', 'paid')->count();
       if($count_paid_interest>0){
        $count_send_data =0;
       }
       return view('frontend.customer.decrease_principle', compact('pawn_data','pawn_interest_data','pawn_send_data','count_send_data'));

    }


    public function PayOutstandingInterest2(Request $request){
        $pawn_barcode = $request->barcode;
        $customer_id = $request->customer_id;
        $add_amount = $request->add_amount;

        $pawn_data = PawnData::where('pawn_barcode', $pawn_barcode)->latest()->first();
        $pawn_send_data = PawnSendInterestData::where('pawn_barcode', $pawn_barcode)->latest()->first();
        $count_send_data = PawnsendInterestData::where('pawn_barcode', $pawn_barcode)->count();
        $pawn_send_id = $pawn_send_data->id;
        $count_paid_interest = PawnTransaction::where('pawn_outstanding_interest_id', $pawn_send_id)->where('payment_status', 'paid')->count();
        if($count_paid_interest>0){
         $count_send_data =0;
        }

          return view('frontend.customer.outstanding_interest', compact('pawn_data','pawn_send_data','count_send_data','customer_id','add_amount'));

    }
}
