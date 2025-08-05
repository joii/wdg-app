<?php

namespace App\Http\Controllers;

use App\Mail\WebsiteMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\PawnData;
use App\Models\PawnInterestData;
use App\Models\PawnOnlineTransaction;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function AdminDashboard(){
        $pawn_data = PawnData::take(10)->orderBy('id','desc')->get();
        // dd($pawn_data);  //For Debugging Purposes
        $pawn_amount = PawnData::whereMonth('pawn_date', Carbon::now()->month)
                     ->whereYear('pawn_date', Carbon::now()->year)
                     ->sum('total_pawn_amount_first');

        // Pawn
        // เดือนนี้
        $currentMonthTotal = PawnData::whereMonth('pawn_date', Carbon::now()->month)
                                ->whereYear('pawn_date', Carbon::now()->year)
                                ->sum('total_pawn_amount_first');

        // เดือนที่แล้ว
        $lastMonth = Carbon::now()->subMonth();
        $lastMonthTotal = PawnData::whereMonth('pawn_date', $lastMonth->month)
                            ->whereYear('pawn_date', $lastMonth->year)
                            ->sum('total_pawn_amount_first');

        // หาค่าส่วนต่าง
        $pawn_difference = $currentMonthTotal - $lastMonthTotal;

        // Interest
        $interest_amount = PawnInterestData::whereMonth('pawn_cal_interest_date', Carbon::now()->month)
                     ->whereYear('pawn_cal_interest_date', Carbon::now()->year)->sum('interest');
        // เดือนที่แล้ว
        $interest_last_month = PawnInterestData::whereMonth('pawn_cal_interest_date',$lastMonth->month)
                     ->whereYear('pawn_cal_interest_date', $lastMonth->year)->sum('interest');
        // หาค่าส่วนต่าง
        $interest_difference =  $interest_amount-$interest_last_month;



        $increase_amount = PawnOnlineTransaction::where('transaction_type','inc')->sum('amount');
        $decrease_amount = PawnOnlineTransaction::where('transaction_type','dec')->sum('amount');

        return view('admin.index', compact('pawn_data','pawn_amount','interest_amount','increase_amount','decrease_amount','pawn_difference','interest_difference'));
    }//End Method

    public function AdminLogin(){
        return view('admin.login');
    }//End Method

    public function AdminLoginSubmit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];

        if(Auth::guard('admin')->attempt($data)){
            return redirect()->route('admin.dashboard')->with('success','Login Successfully');
        }else{
            return redirect()->route('admin.login')->with('error','Login Credentials are Incorrect');
        }
    }//End Method

    public function AdminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success','Logout Successfully');

    }//End Method

    public function AdminForgetPassword(){
        return view('admin.forget_password');
    }//End Method

    public function AdminPasswordSubmit(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);

        $admin_data = Admin::where('email',$request->email)->first();
        if (!$admin_data) {
           return redirect()->back()->with('error','Email Not Found');
        }
        $token = hash('sha256',time());
        $admin_data->token = $token;
        $admin_data->update();

        $reset_link = url('admin/reset-password/'.$token.'/'.$request->email);
        $subject = "Reset Password";
        $message = "Please Clink on below link to reset password<br>";
        $message .= "<a href='".$reset_link." '> Click Here </a>";

        Mail::to($request->email)->send(new WebsiteMail($subject,$message));
        return redirect()->back()->with('success','Reset Password Link Send On Your Email');
    }//End Method

    public function AdminResetPassword($token,$email){
        $admin_data = Admin::where('email',$email)->where('token',$token)->first();

        if (!$admin_data) {
            return redirect()->route('admin.login')->with('error','Invalid Token or Email');
        }
        return view('admin.reset_password',compact('token','email'));

     }//End Method

     public function AdminResetPasswordSubmit(Request $request){
        $request->validate([
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $admin_data = Admin::where('email',$request->email)->where('token',$request->token)->first();
        $admin_data->password = Hash::make($request->password);
        $admin_data->token = "";
        $admin_data->update();

        return redirect()->route('admin.login')->with('success','Password Reset Successfully');
     }//End Method


      public function AdminProfile(){
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        return view('admin.admin_profile',compact('profileData'));
     }

     public function AdminProfileStore(Request $request){
        $id = Auth::guard('admin')->id();
        $data = Admin::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->save();
        return redirect()->back();

    }// End Method


    public function AdminChangePassword(){
        $id = Auth::guard('admin')->id();
        $profile_data = Admin::find($id);
        return view('admin.admin_change_password',compact('profile_data'));
     } // End Method


     public function AdminPasswordUpdate(Request $request){
        $admin = Auth::guard('admin')->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password,$admin->password)) {
            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        /// Update the new password
        Admin::whereId($admin->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
        'message' => 'Password Change Successfully',
        'alert-type' => 'success'
    );
            return redirect()->route('admin.login')->with($notification);
     }// End Method


}
