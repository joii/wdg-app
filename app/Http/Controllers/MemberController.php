<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PawnData;
use App\Models\PawnOnlineTransaction;
use App\Models\Member;
use App\Models\MemberBankAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function memberDashboard()
    {

    $id = Auth::guard('member')->id();
    $profileData = Member::find($id);


    if($profileData->confirm_customer ==1)
    {
      $phone =  $profileData->registered_phone;
    }else{
      $phone =  $profileData->phone;
    }

    $data = PawnData::where('customer_phone',$phone)->get();
    if($data->count()==0)
    {
        $count = 0;
    }else{
         $count = $data->count();
    }

    // Check if member have confirm transaction
     $confirm_data = $profileData->confirm_customer;
     $key = '';
     return view('frontend.member.member_dashboard',compact('data','count','confirm_data','key'));
    }

    public function checkPawnTransaction(Request $request)
    {
         $key = $request->key;
         $id=$request->id;
         $data = PawnData::where('customer_phone',$key)
         ->orWhere('id_card',$key)
         ->get();

         if($data->count()==0)
        {
            $count = 0;
            $is_customer =0;
        }else{
            $count = $data->count();
            $is_customer =1;

            // Update member set customer_phone = $key
        }

        // Check if member have confirm transaction
        $confirm_data = 0;
        return view('frontend.member.member_dashboard',compact('data','count','confirm_data','key','is_customer','id'));


    }

    public function customerConfirmation(Request $request)
    {
        $id = Auth::guard('member')->id();
        $profileData = Member::find($id);
        $phone =  $profileData->phone;
        $key = $request->key;



        DB::table('pawn_data')
        ->where('customer_phone', $key)
        ->update(['member_id' => $id]);


        DB::table('members')
        ->where('id', $id)
        ->update(['confirm_customer' => 1,'registered_phone'=>$phone]); //$key


        // $updatePawnData = PawnData::where('customer_phone', $key)->update([
        //     'member_id' => $id,
        // ]);

        // $updateMember = Member::where('id', $id)->update([
        //     'confirm_customer' => 1,
        //     'registered_phone' => $key,
        // ]);


        $data = PawnData::where('customer_phone',$key)
         ->orWhere('id_card',$key)
         ->orWhere('member_id',$id)
         ->get();

        if($data->count()==0)
        {
            $count = 0;

        }else{
            $count = $data->count();

        }

        // Check if member have confirm transaction
        $confirm_data = 1;
        return view('frontend.member.member_dashboard',compact('data','count','confirm_data','key','id'));


    }


     public function memberProfile()
    {

    $id = Auth::guard('member')->id();
    $profileData = Member::find($id);
    $bankAccountData = MemberBankAccount::where('member_id',$id)->get();
     return view('frontend.member.member_profile',compact('profileData','bankAccountData'));
    }
}
