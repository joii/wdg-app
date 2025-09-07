<?php

namespace App\Http\Controllers\WebAPI;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Http\Requests\PawnDataRequest;
use App\Models\PawnData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PawnDataController extends Controller
{

    public function getPawnDataRecords()
    {
        $PawnDataRecords = PawnData::getPawnDataRecords();

        return response()->json([
            'status' => 'success',
            'data' => $PawnDataRecords,
        ], 200);
    }

    public function findLatestImportFile()
    {
        $folder = storage_path('app/public/import');
        $files = glob($folder . '/Prawn_*.csv');

        if (empty($files)) {
            return null;
        }

        usort($files, fn($a, $b) => filemtime($b) - filemtime($a));
        return basename($files[0]); // return only the filename
     }

    public function importRecord()
    {

        set_time_limit(0);

        $file = $this->findLatestImportFile();
        $csvFile = storage_path('app/public/import/'.$file);


        try{


        if (file_exists($csvFile)) {

            Excel::import(new \App\Imports\PawnDataImport($file), $csvFile);

            // Move the imported file to the processed folder
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



        }catch (\Throwable $e) {
                // Log failed
                Log::error("CSV import failed for {$file}", [
                    'error' => $e->getMessage(),
                ]);

                if($file==null){
                    $file = "Prawn_".date('Ymd').'_'.date('His').'.csv';
                }

                DB::table('import_logs')->insert([
                    'filename' => $file,
                    'status'   => 'failed',
                    'error'    => $e->getMessage(),
                    'message'    => $file.' not found.',
                    'code'       => 404, // HTTP Status Code 200 เสร็จสิ้น
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }


    }


}
