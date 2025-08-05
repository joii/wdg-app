<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PawnSub100mData;
use App\Models\PawnData;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class ProcessPawnSub100M extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-pawn-sub100-m';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'อ่านข้อมูลจาก Table pawn_data ตรวจสอบกับ Table pawn_sub100m_data และอัปเดต Table pawn_sub100m_data  ให้ is_erased = 1  โดยแบ่งชุดข้อมูลครั้งละ 1000 (chunk).';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         // รับค่าขนาด chunk จาก option หรือใช้ค่าเริ่มต้น 1000
        $chunkSize = 1000; //(int) $this->option('chunk-size');
        $this->info("=== เริ่มต้นประมวลผลข้อมูลด้วยขนาด chunk: {$chunkSize} === ");

        $totalProcessed = 0; // จำนวนรายการทั้งหมดที่ประมวลผลจาก Table pawn_data
        $totalUpdated = 0;   // จำนวนรายการที่ถูกอัปเดตใน Table pawn_sub100m_data

        try {
            // ใช้ chunkById เพื่อวนอ่านข้อมูลจาก Table pawn_data ทีละชุด
            // แนะนำให้เพิ่มเงื่อนไข `where` ถ้าคุณต้องการประมวลผลเฉพาะบางรายการ
            // เช่น where('created_at', now()) เพื่อประมวลผลเฉพาะรายการที่ยังไม่ถูกประมวลผล
            PawnData::query()
                  // คุณสามารถเพิ่มเงื่อนไขอื่นๆ ก่อน chunkById ได้ เช่น
                  // ->where('created_at', '>', now()->subDays(30))
                  ->chunkById($chunkSize, function ($tableAItems) use (&$totalProcessed, &$totalUpdated) {
                      $currentChunkCount = $tableAItems->count();
                      $this->info("-> กำลังประมวลผลข้อมูลจำนวน {$currentChunkCount} รายการใน chunk นี้...");

                      $idsToUpdate = []; // อาร์เรย์สำหรับเก็บ ID ของ TableA ที่จะถูกอัปเดตใน batch นี้

                      // วนลูปผ่านแต่ละรายการใน chunk ของ PawnData
                      foreach ($tableAItems as $itemA) {
                          // ตรวจสอบว่ามีข้อมูลใน TableB ที่ตรงกับเงื่อนไขหรือไม่
                          // ในที่นี้สมมติว่า TableA.ref_id ตรงกับ TableB.related_id
                          $existsInTableB = PawnSub100mData::where('pawn_barcode', $itemA->pawn_barcode)
                                                  ->exists();
                          if ($existsInTableB) {
                              $idsToUpdate[] = $itemA->pawn_barcode; // เก็บ pawn_barcode ของรายการใน Table pawn_data ที่ต้องการอัปเดต
                          }
                      }

                      // ทำการอัปเดตข้อมูลแบบ Batch ใน PawnSub100mData
                      if (!empty($idsToUpdate)) {
                          DB::transaction(function () use ($idsToUpdate, &$totalUpdated) {
                              $updatedRows =  PawnSub100mData::whereIn('pawn_barcode', $idsToUpdate)->update(['is_erased' => '1']);
                              $totalUpdated += $updatedRows;
                              $this->info("   อัปเดตข้อมูลใน PawnSub100mData จำนวน {$updatedRows} รายการใน chunk นี้");


                          });
                      } else {
                          $this->info("   ไม่มีข้อมูลใน PawnSub100mData ที่ตรงตามเงื่อนไขเพื่ออัปเดตใน chunk นี้");
                      }

                      $totalProcessed += $currentChunkCount;
                      $this->info("-> ประมวลผลไปแล้วทั้งหมด: {$totalProcessed} รายการ");

                      // สำหรับกรณีที่มีข้อมูลเยอะมากๆ คุณอาจต้องการจำกัดจำนวนการประมวลผลเพื่อทดสอบ
                      // if ($totalProcessed >= 50000) {
                      //     return false; // หยุดการประมวลผล chunk ต่อไป
                      // }
                  });

            $this->info("=== การประมวลผลเสร็จสิ้น! ===");
            $this->info("จำนวนรายการที่ประมวลผลจาก TableA ทั้งหมด: {$totalProcessed}");
            $this->info("จำนวนรายการที่ถูกอัปเดตใน TableA ทั้งหมด: {$totalUpdated}");
            return SymfonyCommand::SUCCESS;

        } catch (\Exception $e) {
            $this->error("เกิดข้อผิดพลาดระหว่างการประมวลผล: " . $e->getMessage());
            $this->error("ไฟล์: " . $e->getFile() . " บรรทัด: " . $e->getLine());
            return SymfonyCommand::FAILURE;
        }
    }
}
