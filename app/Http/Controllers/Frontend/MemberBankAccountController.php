<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\MemberBankAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MemberBankAccountController extends Controller
{
    public function CreateBankAccount()
    {
        return view('frontend.member.bank_account.create');
    }

   public function StoreBankAccount(Request $request){

        $member_id = Auth::guard('member')->id(); // get member_id
        $path = public_path('uploads/member/book_bank/' . $member_id);
        $use_status = 'general'; // general use status

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
            $use_status = 'default'; // default use status
        }

        $request->validate([
            'bank_account_number' =>'required',
            'bank_name' =>'required',
            'account_holder_name' =>'required',
            'book_bank' =>'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

         if ($request->file('book_bank')) {
            $image = $request->file('book_bank');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->scale(width: 1000)->save($path.'/'.$name_gen);
            $save_url = 'uploads/member/book_bank/' . $member_id.'/'.$name_gen;

            MemberBankAccount::create([
                'member_id' => $member_id,
                'bank_account_number' => $request->bank_account_number,
                'bank_name' => $request->bank_name,
                'account_holder_name' => $request->account_holder_name,
                'book_bank' => $save_url,
                'use_status' => $use_status,
                'status' => 'active',
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return redirect()->route('member.member_profile')->with($notification);

    }

    public function EditBankAccount($id)
    {
        $data = MemberBankAccount::find($id);
        return view('frontend.member.bank_account.edit', compact('data'));
    }

    public function UpdateBankAccount(Request $request){
            $id = $request->id;
            $save_url = $request->old_book_bank;
            $member_id = Auth::guard('member')->id(); // get member_id

            $path = public_path('uploads/member/book_bank/' . $member_id);

        if ($request->file('book_bank')) {

            $image = $request->file('book_bank');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->scale(width: 1000)->save($path.'/'.$name_gen);
            $save_url = 'uploads/member/book_bank/' . $member_id.'/'.$name_gen;



            if(file_exists($request->old_book_bank))
            {
                unlink($request->old_book_bank);
            }

        }

            $data = MemberBankAccount::find($id);
            $data->member_id = $request->member_id;
            $data->bank_account_number = $request->bank_account_number;
            $data->bank_name = $request->bank_name;
            $data->account_holder_name = $request->account_holder_name;
            $data->book_bank = $save_url;
            $data->use_status = $request->use_status;
            $data->status = $request->status;
            $data->save();


            $notification = array(
                'message' => 'บันทึกข้อมูลสำเร็จ',
                'alert-type' => 'success'
            );

            return redirect()->route('member.member_profile')->with($notification);
        }

         public function DestroyBankAccount(Request $request)
        {
            $id = $request->id;
            $bank_account = MemberBankAccount::findOrFail($id);

            if(file_exists($bank_account->book_bank))
            {
                unlink($bank_account->book_bank);
            }

            $bank_account->delete();

            $notification = array(
                'message' => 'ลยข้อมูลสำเร็จ',
                'alert-type' => 'success'
            );

             return redirect()->route('member.member_profile')->with($notification);
        }




}
