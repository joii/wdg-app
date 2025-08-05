<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotions;
use App\Models\Banner;

class PromotionsController extends Controller
{
    public function PromotionsList()
    {
            $data = Promotions::where('status','active')->orderBy('start_date','desc')->get();
            $banner = Banner::where('status','active')->first();
            return view('frontend.promotions.index', compact('data','banner'));
    }

    public function PromotionDetail(String $id,$slug){
        $data = Promotions::find($id);
        $banner = Banner::where('status','active')->first();
        return view('frontend.promotions.detail', compact('data','banner'));
    }
}
