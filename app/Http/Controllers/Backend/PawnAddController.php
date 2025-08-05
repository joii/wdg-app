<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PawnData;
use App\Models\PawnAddData;
use Illuminate\Support\Facades\DB;

class PawnAddController extends Controller
{
    public function Index(){

        $pawn_data = PawnData::all();

        return view('backend.pawn_add.index',compact('pawn_data'));
    }

    public function PawnAddList(string $pawn_barcode)
    {
     $pawn_add_data = PawnAddData::where('pawn_barcode', $pawn_barcode)->get();
    //  $pawn_add_data = DB::table('pawn_add_data')
    //                     ->select('pawn_id','pawn_barcode','pawn_expire_date','pawn_add','period','pawn_date_cal_interest')
    //                     ->where('pawn_barcode', $pawn_barcode)
    //                     ->groupBy('pawn_id','pawn_barcode'])
    //                     ->get();
     return view('backend.pawn_add.pawn_add_list', compact('pawn_add_data'));
    }
}
