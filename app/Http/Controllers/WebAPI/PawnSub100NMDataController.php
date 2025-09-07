<?php

namespace App\Http\Controllers\WebAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PawnSub100NMDataRequest;
use App\Models\PawnSub100nmData;
use App\Models\PawnData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        set_time_limit(0);
        $file = $this->findLatestImportFile();
        $csvFile = storage_path('app/public/import/'.$file);


         try {

                if (file_exists($csvFile)) {

                            Excel::import(new \App\Imports\PawnSub100NMDataImport($file), $csvFile);

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

            } catch (\Throwable $e) {
                // Log failed
                Log::error("CSV import failed for {$file}", [
                    'error' => $e->getMessage(),
                ]);

                if($file==null){
                    $file = "Prawn_Sub100NM_".date('Ymd').'_'.date('His').'.csv';
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

      public function importRecord2() //PawnSub100NMDataRequest $request
    {

        set_time_limit(0);
        $file = $this->findLatestImportFile();
        $csvFile = storage_path('app/public/import/'.$file);


        if (file_exists($csvFile)) {
           // Excel::import(new \App\Imports\PawnSub100NMDataImport, $csvFile);

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

        function checkForUpdatePawnSub100nmData()
    {
        $today = Carbon::today();

            $check = DB::table('import_logs')
            ->where('status', 'completed')
            ->where('check_erased', NULL)
            ->whereDate('created_at', $today)
            ->get();
        if(count($check) > 0){

            // ดึงข้อมูลจาก Table pawn_sub100m_data ทีเพิ่มเข้ามาใหม่าในวันนี้
            $rows = DB::table('pawn_sub100nm_data')
               // ->where('status', '<>', 1)
                ->whereDate('created_at', $today)
                ->get();

            foreach ($rows as $row) {
                $codeExists = DB::table('pawn_data')
                    ->where('pawn_barcode', $row->pawn_barcode)
                    ->exists();

                if ($codeExists) {
                    // 1. อัปเดต is_erased = 1
                     DB::table('pawn_data')
                        ->where('pawn_barcode', $row->pawn_barcode)
                        ->update(['is_erased' => 1]);

                    DB::table('pawn_sub100nm_data')
                        ->where('id', $row->id)
                        ->update(['is_erased' => 1]);
                    $data = [
                    'pawn_sub100nm_id' => $row->pawn_sub100nm_id,
                    'pawn_barcode' => $row->pawn_barcode,
                    'stock_category_id' => $row->stock_category_id,
                    'weight_gram' =>$row->weight_gram,
                    'quantity' => $row->quantity,
                    'is_erased' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                    ];

                    DB::table('pawn_sub100nm_data')->insert($data);

                }
            }

            // 2. update check_erased = 1
            DB::table('import_logs')
                ->where('status', 'completed')
                ->where('check_erased', NULL)
                ->whereDate('created_at', $today)
                ->update(['check_erased' => 1]);
        }
    }

    public function syncPawnData()
    {
        DB::transaction(function () {
            // 1. ดึงข้อมูล pawn_data ที่ import วันนี้และยังไม่ได้ sync
            $today = Carbon::today();
            $pawnDataList = PawnData::whereDate('created_at', $today)
                ->where('pawn_import_status', 0)
                ->get();

            foreach ($pawnDataList as $pawn) {
                // 2. ถ้า pawn_online_status = Update และ barcode ตรง
                if ($pawn->pawn_online_status === 'Update') {
                    PawnSub100nmData::where('pawn_barcode', $pawn->pawn_barcode)
                        ->update(['is_erased' => 1]);

                // 3. insert ข้อมูลใหม่ลง pawn_sub100nm_data
                // Data from pawn_sub100nm_data table
                $pawn_sub100nm = PawnSub100nmData::where('pawn_barcode', $pawn->pawn_barcode)
                                                ->first();
                if ($pawn_sub100nm) {
                    $pawn_sub100nm_id = $pawn_sub100nm->pawn_sub100m_id;
                    $stock_category_id = $pawn_sub100nm->stock_category_id;
                    $quantity = $pawn_sub100nm->quantity;
                }


                PawnSub100nmData::create([
                    'pawn_sub100nm_id' => $pawn_sub100nm_id,
                    'pawn_barcode'   => $pawn->pawn_barcode,
                    'stock_category_id' => $stock_category_id,
                    'weight_gram'     => $pawn->weight_100nm_total,
                    'quantity'      => $quantity,
                    // เพิ่ม fields ที่จำเป็นตามตาราง
                    'is_erased'      => 0,
                ]);

                } // close  if ($pawn->pawn_online_status === 'Update')



                // 4. update pawn_data ว่าทำการ import แล้ว
                PawnData::where('id', $pawn->id)
                        ->where('pawn_barcode', $pawn->pawn_barcode)
                        ->update(['pawn_import_status' => 1]);

            }
        });
    }
}
