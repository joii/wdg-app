<?php

namespace App\Http\Controllers\WebAPI;

use App\Exports\PawnInterestExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PawnInterestController extends Controller
{
    public function exportPawnInterestData(Request $request)
    {
        $filename = 'PawnInterestExport_'.date('YmdHis').'.csv';
        // $file_path = storage_path($filename);
        // return Excel::download(new PawnInterestExport, $filename);
         return Excel::store(new PawnInterestExport, $filename);
    }
}
