<?php

namespace App\Listeners;

use App\Events\PawnSub100MCsvImported;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\Excel\Events\ImportFailed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LogPawnSub100MCsvImportFailed
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
          // 1.เขียน log ลง database
        DB::table('import_logs')->insert([
            'filename'   => $event->filename,
            'status'     => 'completed',
            'message'    => 'Imported Failed',
            'code'       => 100, // HTTP Status Code 200 เสร็จสิ้น
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // 2. เขียน log ลงไฟล์ storage/logs/laravel.log
        Log::info('CSV imported successfully:', [
            'filename' => $event->filename,
            'time' => now()->toDateTimeString(),
        ]);


        // 3. ส่งอีเมลแจ้งเตือน (ใช้ Mailable)
        // Mail::raw("File {$event->filename} imported successfully!", function ($message) {
        //     $message->to('contact.puipui@gmail.com')
        //             ->subject('CSV Import Completed');
        // });
    }
}
