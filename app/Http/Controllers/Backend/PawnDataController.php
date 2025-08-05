<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PawnData;
use App\Models\PawnAddData;

class PawnDataController extends Controller
{
    public function Index(){

        $pawn_data = PawnData::all()->orderBy('id', 'desc');
        $pawn_add_data = PawnAddData::all();
        return view('backend.pawn_add.index',compact('pawn_data'));
    }
}
