<?php

namespace App\Listeners;

use Maatwebsite\Excel\Events\ImportFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LogCsvImportFailed
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
   public function handle(ImportFailed $event): void
    {
    //     $file = $event->reader->getFile()->getBasename();
    //    // ชื่อไ��ล์ที่ทำการ import ��ิดพลา�� (เช่น invalid_file.csv)


    //     // 1.เขียน log ลง database
    //     DB::table('import_logs')->insert([
    //         'filename'   => $file,
    //         'status'     => 'failed',
    //         'message'    => 'Imported failed',
    //         'code'       => 100, // HTTP Status Code 200 เสร็จสิ้น
    //         'error'      => $event->getException()->getMessage(),
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //     ]);


    //     // 2. เขียน log ลงไฟล์ storage/logs/laravel.log
    //     Log::info('Imported failed:', [
    //         'filename' => $file,
    //         'error' => $event->getException()->getMessage(),
    //         'time' => now()->toDateTimeString(),
    //     ]);

    }
}
