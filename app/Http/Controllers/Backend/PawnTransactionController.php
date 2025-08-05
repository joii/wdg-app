<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PawnAddData;
use Illuminate\Http\Request;
use App\Models\PawnData;
use App\Models\PawnInterestData;

class PawnTransactionController extends Controller
{
    public function Index(){

        $pawn_data = PawnData::all();
        return view('backend.pawn_transaction.index',compact('pawn_data'));
    }

    public function Latest(){
        $pawn_data = PawnData::take(20)->get();
        return view('backend.pawn_transaction.latest',compact('pawn_data'));
    }

    public function Contract(String $id){
        $data = PawnData::find($id);
        $pawn_add_data = PawnAddData::where('pawn_id',$data->pawn_id)->get();
        $pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
        return view('backend.pawn_transaction.contract',compact('data','pawn_interest_data'));
    }

    public function Print(String $id){
        $data = PawnData::find($id);
        $pawn_add_data = PawnAddData::where('pawn_id',$data->pawn_id)->get();
        $pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
        return view('backend.pawn_transaction.print',compact('data','pawn_interest_data'));
    }

    public function Detail(String $id){
        $data = PawnData::find($id);
        $pawn_add_data = PawnAddData::where('pawn_id',$data->pawn_id)->get();
        $pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
        return view('backend.pawn_transaction.detail',compact('data','pawn_interest_data'));
    }

    public function Edit(String $id){
        $data = PawnData::find($id);
        $pawn_add_data = PawnAddData::where('pawn_id',$data->pawn_id)->get();
        $pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
        return view('backend.pawn_transaction.edit',compact('data','pawn_interest_data'));
    }

    public function Update(Request $request){
        $id = $request->id;
        $data = PawnData::findOrFail($id);
        $data->customer_name = $request->customer_name;
        $data->customer_address = $request->customer_address;
        $data->customer_phone = $request->customer_phone;
        $data->id_card = $request->id_card;
        $data->save();

        $notification = array(
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'alert-type' => 'success'
        );

        return back()->withInput()->with('notification');
    }

    public function Interest(String $id){
        $data = PawnData::find($id);
        $pawn_add_data = PawnAddData::where('pawn_id',$data->pawn_id)->get();
        $pawn_interest_data = PawnInterestData::where('pawn_id',$data->pawn_id)->get();
        return view('backend.pawn_transaction.pawn_interest',compact('data','pawn_interest_data'));
    }
}
