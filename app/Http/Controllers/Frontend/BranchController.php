<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Banner;


class BranchController extends Controller
{
    public function branchList()
    {
            $data = Branch::where('status','active')->get();
            $banner = Banner::where('status','active')->first();
            return view('frontend.branch', compact('data','banner'));
    }
}
