<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PawnData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Services\SMS\ThaiBulkSmsService;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.login');
    }

     public function Login(Request $request)
    {
         $request->validate([
            'user' => 'required',
            'password' => 'required|min:8',
        ]);

        $check = $request->all();
        $data = [
            'phone' => $check['user'],
            'password' => $check['password'],
        ];


        // $notification = array(
        //     'message' => 'Login Successful!  ',
        //     'alert-type' =>'success',
        // );

        if(Auth::guard('member')->attempt($data)){
            return redirect()->route('member.member_dashboard')->with('success','Login Successfully');
        }else{
            return redirect()->route('member.login')->with('error','Login Credentials are Incorrect');
        }
    }



     public function SendSMS($phone,$message)
    {
        $sms = new ThaiBulkSmsService();
        $response = $sms->send($phone,$message);

        return response()->json($response);
    }


     public function showRegisterForm()
    {
        return view('frontend.register');
    }

     public function Register(Request $request)
    {

        // $request->validate([
        //   'firstname' => 'required',
        //   'lastnamen' => 'required',
        //   'phone' => 'required',
        //   'password' => ['required', 'confirmed',Rules\Password::defaults()],

        // ]);

        Member::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
            'status' => 'active',
        ]);

        // Send SMS to user about vierify link
        $message = "กรุณายืนยันตัวตนที่ https://app.wisdom-gold.com/member/login";
        $this->SendSMS($request->phone,$message);

        $notification = array(
            'message' => 'Registration Successful! Please Login to Continue.  Click here to Login.  ',
            'alert-type' =>'success',
        );

        return redirect()->route('member.login')->with($notification);

    }

    public function Logout(){
        Auth::guard('member')->logout();
        return redirect()->route('member.login')->with('success','Logout Successfully');

    }//End Method


}
