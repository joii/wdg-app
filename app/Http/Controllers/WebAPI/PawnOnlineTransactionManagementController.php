<?php

namespace App\Http\Controllers\WebAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\PawnOnlineTransactionExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class PawnOnlineTransactionManagementController extends Controller
{
    public function exportPawnTransactionsToCsv()
{
    // ตั้งชื่อไฟล์แบบมีวันที่เวลา
    $timestamp = now()->format('Ymd_His');
    $fileName = "PawnOnlineTransaction_{$timestamp}.csv";
    $folderName = now()->format('Ymd');
    $filePath = "export/{$folderName}/{$fileName}";

    // ตรวจสอบว่ามีโฟลเดอร์ export แล้วหรือยัง (ถ้ายังให้สร้าง)
    if (!Storage::disk('public')->exists('export')) {
        Storage::disk('public')->makeDirectory('export');
    }

    // บันทึกไฟล์ไปยัง storage/app/public/export/
    Excel::store(new PawnOnlineTransactionExport, $filePath, 'public', \Maatwebsite\Excel\Excel::CSV);

    return response()->json([
        'message' => 'Pawn Onlint Transaction Export Successfully',
        'file_url' => asset("storage/{$filePath}"),
        'file_path' => $filePath,
    ]);
}
}
