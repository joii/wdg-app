<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoldPrice;

class GoldPriceController extends Controller
{
    public function Index(){
        $data = GoldPrice::orderBy('id','desc')->get();
        return view('backend.gold_price.index',compact('data'));
    }
}
