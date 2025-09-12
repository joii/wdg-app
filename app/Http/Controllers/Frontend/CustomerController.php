<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PawnData;
use App\Models\Customers;
use App\Models\PawnInterestData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;


class CustomerController extends Controller
{
    public function Contract(String $pawn_barcode)
    {
        $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();
        if (!$data) {
            abort(404);
        }
        $customer = Customers::where('id', $data->customer_id)->first();
        $banner = Banner::where('status','active')->first();
        return view('frontend.customer.contract', compact('data', 'customer','banner'));
    }

     public function consignmentDetail(String $pawn_barcode)
    {
        $data = PawnData::where('pawn_barcode', $pawn_barcode)->first();
        $interest_data = PawnInterestData::where('pawn_barcode', $pawn_barcode)->take(6)->orderBy('created_at','desc')->get();
        if (!$data) {
            abort(404);
        }
        $customer = Customers::where('id', $data->customer_id)->first();
        $banner = Banner::where('status','active')->first();
        return view('frontend.customer.consignment_detail', compact('data', 'customer','interest_data','banner'  ));
    }
}
