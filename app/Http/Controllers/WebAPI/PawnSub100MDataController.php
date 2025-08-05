<?php

namespace App\Http\Controllers\WebAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PawnSub100MDataRequest;
use App\Models\PawnSub100mData;
use App\Models\PawnData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PawnSub100MDataController extends Controller
{
    public function getPawnSub100mDataRecords()
    {
        $PawnSub100mDataRecords = PawnSub100mData::getPawnSub100mDataRecords();

        return response()->json([
            'status' => 'success',
            'data' => $PawnSub100mDataRecords,
        ], 200);
    }

    public function importRecord(PawnSub100mDataRequest $request)
    {
        try {
           // ใช้ Request Form สำหรับ test ด้วย postman ด้วย form ที่ส่งมา
            $csvFile = $request->file('csvFile');
           // ใช้การอ่านไฟล์ CSV จาก Physical Storage
           //ini_set('memory_limit', '256M');
           //$csvFile = storage_path('app/public/Prawn_Sub100M_20250610_135101');

            Excel::import(new \App\Imports\PawnSub100MDataImport, $csvFile);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 400);
        }

        // บันทึกข้อมูลลงฐานข้อมูลสำเร็จ
        return response()->json([
            'status' => 'success',
            'message' => 'Operation successful.'
        ], 201);
    }

    function updatePawnSub100mData()
    {
            $today = Carbon::today();

            // ดึงข้อมูลจาก Table pawn_sub100m_data ทีเพิ่มเข้ามาใหม่าในวันนี้
            $rows = DB::table('pawn_data')
               // ->where('status', '<>', 1)
                ->whereDate('created_at', $today)
                ->get();

            foreach ($rows as $row) {
                $codeExists = DB::table('pawn_sub100m_data')
                    ->where('pawn_barcode', $row->pawn_barcode)
                    ->exists();

                if ($codeExists) {
                    // 1. อัปเดต is_erased = 1
                    DB::table('pawn_sub100m_data')
                        ->where('id', $row->id)
                        ->update(['is_erased' => 1]);

                    // 2. คัดลอก row ลง  pawn_sub100m_data ใหม่ (insert ซ้ำ)
                    $newRow = (array) $row;
                   // unset($newRow['id']); // ลบ id เก่า เพื่อไม่ให้ชนกัน
                    $newRow['is_erased'] = 0; // หรือ status เริ่มต้นอื่น
                    $newRow['created_at'] = now();
                    $newRow['updated_at'] = now();

                    DB::table('pawn_sub100m_data')->insert($newRow);
                }
            }
    }
}
