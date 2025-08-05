<?php

namespace App\Http\Controllers\WebAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PawnSub100NMDataRequest;
use App\Models\PawnSub100nmData;

class PawnSub100NMDataController extends Controller
{
    public function getPawnSub100nmDataRecords()
    {
        $PawnSub100nmDataRecords = PawnSub100nmData::getPawnSub100nmDataRecords();

        return response()->json([
            'status' => 'success',
            'data' => $PawnSub100nmDataRecords,
        ], 200);
    }

    public function findLatestImportFile()
    {
        $folder = storage_path('app/public/import');
        $files = glob($folder . '/Prawn_Sub100NM_*.csv');

        if (empty($files)) {
            return null;
        }

        usort($files, fn($a, $b) => filemtime($b) - filemtime($a));
        return basename($files[0]); // return only the filename
     }

    public function importRecord() //PawnSub100NMDataRequest $request
    {
        // try {
        //     $csvFile = $request->file('csvFile');
        //     Excel::import(new \App\Imports\PawnSub100NMDataImport, $csvFile);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $th->getMessage()
        //     ], 400);
        // }
        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Operation successful.'
        // ], 201);

        set_time_limit(0);
        $file = $this->findLatestImportFile();
        $csvFile = storage_path('app/public/import/'.$file);


        if (file_exists($csvFile)) {
            Excel::import(new \App\Imports\PawnSub100NMDataImport, $csvFile);

            $fileProcessed = storage_path("app/public/import/processed/{$file}");

            // Check if the file exists before trying to move it
            if (file_exists($csvFile)) {
                // Move the file to the processed folder
                rename($csvFile, $fileProcessed);
                $message = "Moved {$file} to processed folder.";
            } else {
                $message = "File {$file} not found.";
            }

            return response()->json([
                'status' => 'success',
                'message' => $message
            ], 201);


        }else{
                return response()->json([
                'status' => 'error',
                'message' => $file.' is not found.'
            ], 200);
        }
    }
}
