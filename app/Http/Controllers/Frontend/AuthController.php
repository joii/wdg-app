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
use App\Services\OtpService;
use App\Models\Otp;

class AuthController extends Controller
{

    // protected $otpService;
    protected $ThaiBulkSmsService;

    // public function __construct(OtpService $otpService)
    // {
    //     $this->otpService = $otpService;
    // }



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



    //  public function SendSMS($phone,$message)
    // {
    //    // $sms = new ThaiBulkSmsService();
    //    // $response = $sms->send($phone,$message);
    //    // $this->ThaiBulkSmsService->sendSMS($phone,$message);

    //     return response()->json($response);
    // }


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

        $otp = rand(100000,999999);

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
       // $message = "รหัสยืนยันตัวตน คือ ".$otp;
       // $this->SendSMS($request->phone,$message);
        //$this->ThaiBulkSmsService->sendSMS($request->phone,$message);

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


    public function requestOtp2(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits_between:9,12'
        ]);

        $phone = $request->phone;

        $otp = new OtpService();
        $result = $otp->requestOtp($phone);



        if ($result && isset($result['token'])) {
            // redirect ไปหน้า verify พร้อม token
            return redirect()->route('otp.verify.form', ['token' => $result['token'], 'phone' => $phone]);
        }

        return back()->withErrors(['msg' => 'Request OTP failed, please try again.']);
    }

    public function showVerifyForm(Request $request)
    {
        return view('frontend.verify_otp', [
            'token' => $request->query('token'), // รับ token จาก redirect
            'phone' => $request->query('phone'),
        ]);
    }



    // Verify OTP
    public function verifyOtp2(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'otp_code' => 'required|digits:6',
        ]);

        $phone = $request->phone;

        $otp = new OtpService();
        $result = $otp->verifyOtp($request->token, $request->otp_code);

        if ($result && ($result['status'] ?? null) === 'success') {

             // หา user จากเบอร์โทร
            $member = Member::where('phone', $request->phone)->first();

            if (!$member) {
                return back()->withErrors(['phone' => 'ไม่พบผู้ใช้งาน'.$phone]);
            }

            // login ด้วย guard member
            Auth::guard('member')->login($member);
            return redirect()->route('member.member_dashboard')->with('success','เข้าสู่ระบบเรียบร้อย');
            //return redirect('/home')->with('status', 'OTP verified successfully!');
        }

        return back()->withErrors(['msg' => 'Invalid OTP code, please try again.']);
    }



}
