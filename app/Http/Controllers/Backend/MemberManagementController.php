<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberManagementController extends Controller
{
    public function Index(){

        $data = Member::orderBy('id','desc')->get();
        return view('backend.members.index',compact('data'));
    }

    public function Latest(){

        $data = Member::whereMonth('created_at', Carbon::now()->month)->get();
        return view('backend.members.latest',compact('data'));
    }

    public function Detail(String $id){
        $data = Member::find($id);

        return view('backend.members.detail',compact('data'));
    }

    public function Register(){
        return view('backend.members.register');
    }

    public function Store(Request $request)
    {
        Member::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
            'status' => 'active',
        ]);


        $notification = array(
            'message' => 'Registration Successful! Please Login to Continue.  Click here to Login.  ',
            'alert-type' =>'success',
        );

        return redirect()->route('member.login')->with($notification);

    }


}
