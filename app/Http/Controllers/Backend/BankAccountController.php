<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Models\Branch;

class BankAccountController extends Controller
{
    public function Index(){
        $data = BankAccount::join('branches', 'branches.id', '=', 'bank_accounts.branch_id')
                       ->get(['branches.name', 'bank_accounts.*']);
         return view('backend.bank_account.index', compact('data'));
     }

     public function Create(){
        $branches = Branch::latest()->get();
        return view('backend.bank_account.create',compact('branches'));
    }

    public function Store(Request $request){
        $request->validate([
          'branch_id' => 'required',
          'bank_account_name' => 'required',
          'bank_account_no' => 'required',

        ]);

        BankAccount::create([
          'branch_id' => $request->branch_id,
          'bank_account_name' => $request->bank_account_name,
          'bank_account_no' => $request->bank_account_no,
          'add_date' => now(),
          'status' => $request->status,
      ]);

      $notification = array(
          'message' => 'บันทึกข้อมูลสำเร็จ',
          'alert-type' => 'success'
      );

      $data = BankAccount::join('branches', 'branches.id', '=', 'bank_accounts.branch_id')
      ->get(['branches.name', 'bank_accounts.*']);
       return view('backend.bank_account.index', compact('data'));
      //return view('backend.interest_rate.index', compact('data'))->with($notification);
    }

    public function Edit(String $id){
        $data = BankAccount::find($id);
        $branches = Branch::latest()->get();
        return view('backend.bank_account.edit', compact('data','branches'));
    }

    public function Update(Request $request){
        $id = $request->id;
        $data = BankAccount::findOrFail($id);
        $data->branch_id = $request->branch_id;
        $data->bank_account_name = $request->bank_account_name;
        $data->bank_account_no = $request->bank_account_no;
        $data->api_key = $request->api_key;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        $data = BankAccount::join('branches', 'branches.id', '=', 'bank_accounts.branch_id')
        ->get(['branches.name', 'bank_accounts.*']);

        return view('backend.bank_account.index', compact('data'))->with($notification);
    }

    public function Destroy(string $id)
    {
        $bank_account = BankAccount::findOrFail($id);
        $bank_account->delete();

        $notification = array(
            'message' => 'ลยข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

       // return redirect()->route('backend.interest_rate.index')->with($notification);
       $data = BankAccount::join('branches', 'branches.id', '=', 'bank_accounts.branch_id')
        ->get(['branches.name', 'bank_accounts.*']);

        return view('backend.bank_account.index', compact('data'))->with($notification);
    }
}
