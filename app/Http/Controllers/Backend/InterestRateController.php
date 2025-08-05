<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InterestRate;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class InterestRateController extends Controller
{
    public function Index(){
       // $data = InterestRate::latest()->get();
       $data = InterestRate::join('branches', 'branches.id', '=', 'interest_rates.branch_id')
              		->get(['branches.name', 'interest_rates.*']);
        return view('backend.interest_rate.index', compact('data'));
    }

    public function Create(){
        $branches = Branch::latest()->get();
        return view('backend.interest_rate.create_bug',compact('branches'));
    }

    public function Store(Request $request){
        $request->validate([
          'branch_id' => 'required',
          'interest_rate' => 'required',
          'status' => 'required',

        ]);

        InterestRate::create([
          'branch_id' => $request->branch_id,
          'interest_rate' => $request->interest_rate,
          'add_date' => now(),
          'status' => $request->status,
      ]);

      $notification = array(
          'message' => 'บันทึกข้อมูลสำเร็จ',
          'alert-type' => 'success'
      );

      $data = InterestRate::join('branches', 'branches.id', '=', 'interest_rates.branch_id')
              		->get(['branches.name', 'interest_rates.*']);
      //return redirect()->route('backend.interest_rate.index',[$data])->with($notification);
      return view('backend.interest_rate.index', compact('data'))->with($notification);
    }

    public function Edit(String $id){
        $data = InterestRate::find($id);
        $branches = Branch::latest()->get();
        return view('backend.interest_rate.edit', compact('data','branches'));
    }

    public function Update(Request $request){
        $id = $request->id;
        $data = InterestRate ::findOrFail($id);
        $data->branch_id = $request->branch_id;
        $data->interest_rate = $request->interest_rate;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        $data = InterestRate::join('branches', 'branches.id', '=', 'interest_rates.branch_id')
        ->get(['branches.name', 'interest_rates.*']);

        return view('backend.interest_rate.index', compact('data'))->with($notification);
    }

    public function Destroy(string $id)
    {
        $interest_rate = InterestRate::findOrFail($id);
        $interest_rate->delete();

        $notification = array(
            'message' => 'ลยข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

       // return redirect()->route('backend.interest_rate.index')->with($notification);
       $data = InterestRate::join('branches', 'branches.id', '=', 'interest_rates.branch_id')
        ->get(['branches.name', 'interest_rates.*']);

        return view('backend.interest_rate.index', compact('data'))->with($notification);
    }
}
