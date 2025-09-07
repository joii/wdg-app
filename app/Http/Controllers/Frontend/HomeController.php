<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoldPrice;
use Carbon\Carbon;
use App\Models\FAQCategory;
use App\Models\faqs;
use App\Models\Banner;
use App\Models\FacebookPixel;
use App\Models\GoogleAnalytic;
use App\Models\GoogleTagManager;
use App\Models\MetaTag;

class HomeController extends Controller
{
    public function Index()
    {
        //$today = Carbon::today(); // Gets the current date at 00:00:00
        //$goldPrices = GoldPrice::where('date', '=', $today)->orderBy('id','desc')->get(); // Fetches gold prices for the current and following days

        // if(count($goldPrices)==0){
        //    $today = Carbon::yesterday(); // Gets the current date at 00:00:00
        //    $goldPrices = GoldPrice::where('date', '=', $today)->orderBy('id','desc')->get();
        // }
        // $yesterday = Carbon::yesterday();
        // $goldPricesYesterday = GoldPrice::where('date', '=', $yesterday)->orderBy('id','desc')->get();
        // $diff = ($goldPrices[0]->buy_gold_bar*1)-($goldPricesYesterday[0]->buy_gold_bar*1); // Calculates the difference in price between the current and following days



        // Gold Price Data
        $goldPrices = GoldPrice::orderBy('id','desc')->get();
        $diff = $goldPrices[0]->buy_gold_bar - $goldPrices[1]->buy_gold_bar; // Calculates the difference in price between the current and following days

        // FAQs
        $faqCategories = FAQCategory::all();
        $faqCategory = FAQCategory::where('id',1)->first();
        $faqCategory_name = $faqCategory->category_name;
        $faqs = faqs::where('category_id',1)->where('status','active')->get();
        $banner = Banner::where('status','active')->first();

        return view('frontend.home',compact('goldPrices','diff','faqs','faqCategories','faqCategory_name','banner'));
    }
}
