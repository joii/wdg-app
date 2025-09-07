<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ProcessPanSub100MDataJob implements ShouldQueue
{
    use Queueable,Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::table('pawn_data')->orderBy('id')->chunk(500, function ($pawnDataList) {
            foreach ($pawnDataList as $pawnData) {
                // อัปเดต is_erased = 1
                DB::table('pawn_sub100m')
                    ->where('pawn_barcode', $pawnData->pawn_barcode)
                    ->update(['is_erased' => 1]);

                // แทรกข้อมูลใหม่
                DB::table('pawn_sub100m')->insert([
                    'pawn_barcode' => $pawnData->pawn_barcode,
                    'stock_category_id' => $pawnData->stock_category_id,
                    'unit_bath' => $pawnData->unit_bath,
                    'unit_salung' => $pawnData->unit_salun,
                    'quantity' =>$pawnData->quantity,
                    'is_erased'    => 0,
                ]);
            }
        });
    }
}
