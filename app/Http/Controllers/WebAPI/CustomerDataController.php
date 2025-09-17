<?php

namespace App\Http\Controllers\WebAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CustomerDataRequest;
use App\Models\Customers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class CustomerDataController extends Controller
{
    public function getCustomersRecords()
    {
        $CustomersRecords = Customers::getCustomersRecords();

        return response()->json([
            'status' => 'success',
            'data' => $CustomersRecords,
        ], 200);
    }

    public function findLatestImportFile()
    {
        $folder = storage_path('app/public/import');
        //$files = glob($folder . '/Customer_*.csv');

        $allFiles = glob($folder . '/Customer_*.*');
        $files = preg_grep('/\.csv$/i', $allFiles); // i = case-insensitive



        if (empty($files)) {
            return null;
        }

        usort($files, fn($a, $b) => filemtime($b) - filemtime($a));
        return basename($files[0]); // return only the filename
     }

    public function importRecord()
    {

            set_time_limit(0);
            //$csvFile = storage_path('app/public/Customer_20250610_135102.csv');

            $file = $this->findLatestImportFile();
            $csvFile = storage_path('app/public/import/'.$file);

        try{

             if (file_exists($csvFile)) {
                Excel::import(new \App\Imports\CustomerDataImport, $csvFile);


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
            $file = "Customer_".date('Ymd').'_'.date('His').'.csv';
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
