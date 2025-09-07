<?php

namespace App\Listeners;

use App\Events\CsvExported;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ExportLog;

class LogCsvExported
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
    public function handle(CsvExported $event): void
    {

        // 1.เขียน log ลง database
        DB::table('export_logs')->insert([
            'filename'   => $event->filename,
            'status'     => 'completed',
            'message'    => 'Imported successfully',
            'code'       => 200, // HTTP Status Code 200 เสร็จสิ้น
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // 2. เขียน log ลงไฟล์ storage/logs/laravel.log
        Log::info('CSV exported successfully:', [
            'filename' => $event->filename,
            'time' => now()->toDateTimeString(),
        ]);
    }
}
