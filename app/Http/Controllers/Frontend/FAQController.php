<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\faqCategory;
use App\Models\faqs;
use App\Models\Banner;

class FAQController extends Controller
{
    public function FaqList()
    {
        $faq_categories = FAQCategory::where('status','active')->get();
        $faqs = faqs::where('status','active')->get();
        $banner = Banner::where('status','active')->first();
        return view('frontend.faqs',compact('faqs','faq_categories','banner'));
    }
}
