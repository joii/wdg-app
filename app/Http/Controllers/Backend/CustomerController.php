<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\PawnData;

class CustomerController extends Controller
{
    public function Index(){

        ini_set('memory_limit', '512M');
        $data = Customers::take(10000)->orderByDesc('id')->get();
        $pawn_data = PawnData::all();
        return view('backend.customer.index',compact('pawn_data','data'));
    }

    public function Latest(){

        $data = Customers::take(50)->orderByDesc('id')->get();
        $pawn_data = PawnData::all();
    //     $items = Model::whereDate('published_at', '<', $date)
    // ->whereNull('removed_at')
    // ->whereNotNull('example_id')
    // ->where('filled', false)
    // ->orderByDesc('example_id')
    // ->first();
        return view('backend.customer.latest',compact('pawn_data','data'));
    }

    public function Detail(String $id){
        $data = Customers::find($id);
        $id_card = $data->id_card;
        $pawn_data = array();
        if($id_card != null || $id_card !=''){
            $pawn_data = PawnData::where('id_card',$id_card)->get();
        }
        $pawn_data = PawnData::where('id_card',$id_card)->get();

        return view('backend.customer.detail',compact('data','pawn_data'));
    }

    public function CustomerInformation(String $customer_name,String $customer_phone){
        $data = Customers::where('tel',$customer_phone)->first();
        $pawn_data = array();
        $pawn_data = PawnData::where('customer_phone',$customer_phone)->get();

        return view('backend.customer.customer_info',compact('data','pawn_data'));
    }

}
