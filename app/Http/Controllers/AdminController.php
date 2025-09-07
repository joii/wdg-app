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
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function AdminDashboard(){

        // For Table Data
         $keyword = "quarter";
         $startDate = Carbon::now()->subDays(90);
         $endDate = Carbon::now();
         $pawn_data = PawnData::whereBetween('pawn_date', [$startDate,$endDate])
            ->orderBy('pawn_date','desc')
            ->get();
        //$pawn_data = PawnData::take(10)->orderBy('id','desc')->get();

        // Pawn Monthly Summary
        $pawn_total_amount = PawnData::whereMonth('pawn_date', Carbon::now()->month)
                     ->whereYear('pawn_date', Carbon::now()->year)
                     ->sum('total_pawn_amount_first');

        // 1.Pawn Summary
        // Total Amount
        $current_month_total_amount = PawnData::whereMonth('pawn_date', Carbon::now()->month)
                                ->whereYear('pawn_date', Carbon::now()->year)
                                ->sum('total_pawn_amount_first');

        // Number of Transaction
        $pawn_total_transaction = PawnData::whereMonth('pawn_date', Carbon::now()->month)
                                ->whereYear('pawn_date', Carbon::now()->year)
                                ->count();

        // 2.Interest Summary
        // Total Amount
        $interest_total_amount = PawnOnlineTransaction::where('transaction_type','intr')->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)->sum('payment_amount');
        // Number of Transaction
        $interest_total_transaction  = PawnOnlineTransaction::where('transaction_type','intr')->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)->count();

        // 3.Increase and Decrease Summary
        // Total Amount
        $increase_total_amount = PawnOnlineTransaction::where('transaction_type','inc')->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)->sum('payment_amount');
        $decrease_total_amount = PawnOnlineTransaction::where('transaction_type','dec')->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)->sum('payment_amount');
        // Increase and Decrease Number of Transaction
        $increase_total_transaction = PawnOnlineTransaction::where('transaction_type','inc')->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)->count();
        $decrease_total_transaction = PawnOnlineTransaction::where('transaction_type','dec')->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)->count();

        // 4.Import Logs
        $import_log = DB::table('import_logs')->orderBy('created_at','desc')->get();

        // 5. Overdue Pawns Interests
        $range = 15;
        $endDate = Carbon::now(); // วันที่ปัจจุบัน
        $startDate = Carbon::now()->subDays($range); // ย้อนหลัง 30 วัน

        $overdue = DB::table('pawn_interest_data')
            ->whereYear('pawn_expire_date', 2025)
            ->whereBetween('pawn_expire_date', [$startDate,$endDate])
            ->select('*')
            ->distinct()
            ->get();

        return view('admin.index', compact('pawn_data','pawn_total_amount','pawn_total_transaction','interest_total_amount','interest_total_transaction','increase_total_amount','increase_total_transaction','decrease_total_amount','decrease_total_transaction','import_log','overdue','keyword','range'));

    }//End Method

        public function AdminLatestDashboard(Request $request){

        // keywords & range
        $keyword = 'quarter';
        if(isset($request->pawn_range)){
            $keyword = $request->pawn_range;
        }
        if(isset($request->overdue_range)){
            $keyword = $request->overdue_range;
        }

        $range = 15;
         if(isset($request->overdue_range)){
            $range = $request->overdue_range;
        }
        if(isset($request->overdue_range)){
            $range = $request->overdue_range;
        }

        // For Table Data
        // keyword : today , yesterday,week,month
        $endDate = Carbon::now(); // วันที่ปัจจุบัน
        switch($keyword){
            case 'today':
                $startDate = Carbon::now();
                $endDate = Carbon::now();
                break;
            case 'yesterday':
                $startDate = Carbon::now()->subDays(1);
                $endDate = Carbon::now();
                break;
            case 'week':
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                break;
            case'month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                break;
            case'quarter':
                $startDate = Carbon::now()->subDays(90);
                $endDate = Carbon::now()->endOfMonth();
                break;
            default:
                $startDate = Carbon::now()->subDays(90);
                $endDate = Carbon::now();
        }
        $pawn_data = PawnData::whereBetween('pawn_date', [$startDate,$endDate])
            ->orderBy('pawn_date','desc')
            ->get();


       // $pawn_data = PawnData::take(10)->orderBy('id','desc')->get();

        // Pawn Monthly Summary
        $pawn_total_amount = PawnData::whereMonth('pawn_date', Carbon::now()->month)
                     ->whereYear('pawn_date', Carbon::now()->year)
                     ->sum('total_pawn_amount_first');

        // 1.Pawn Summary
        // Total Amount
        $current_month_total_amount = PawnData::whereMonth('pawn_date', Carbon::now()->month)
                                ->whereYear('pawn_date', Carbon::now()->year)
                                ->sum('total_pawn_amount_first');

        // Number of Transaction
        $pawn_total_transaction = PawnData::whereMonth('pawn_date', Carbon::now()->month)
                                ->whereYear('pawn_date', Carbon::now()->year)
                                ->count();

        // 2.Interest Summary
        // Total Amount
        $interest_total_amount = PawnOnlineTransaction::where('transaction_type','intr')->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)->sum('payment_amount');
        // Number of Transaction
        $interest_total_transaction  = PawnOnlineTransaction::where('transaction_type','intr')->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)->count();

        // 3.Increase and Decrease Summary
        // Total Amount
        $increase_total_amount = PawnOnlineTransaction::where('transaction_type','inc')->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)->sum('payment_amount');
        $decrease_total_amount = PawnOnlineTransaction::where('transaction_type','dec')->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)->sum('payment_amount');
        // Increase and Decrease Number of Transaction
        $increase_total_transaction = PawnOnlineTransaction::where('transaction_type','inc')->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)->count();
        $decrease_total_transaction = PawnOnlineTransaction::where('transaction_type','dec')->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)->count();

        // 4.Import Logs
        $import_log = DB::table('import_logs')->orderBy('created_at','desc')->get();

        // 5. Overdue Pawns Interests
        $endDate = Carbon::now(); // วันที่ปัจจุบัน
        $startDate = Carbon::now()->subDays($range); // ย้อนหลัง 30 วัน
        $overdue = DB::table('pawn_interest_data')
            ->whereYear('pawn_expire_date', 2025)
            ->whereBetween('pawn_expire_date', [$startDate,$endDate])
            ->select('*')
            ->distinct()
            ->get();

        return view('admin.index', compact('pawn_data','pawn_total_amount','pawn_total_transaction','interest_total_amount','interest_total_transaction','increase_total_amount','increase_total_transaction','decrease_total_amount','decrease_total_transaction','import_log','overdue','keyword','range'));

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
