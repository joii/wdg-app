<?php

namespace App\Imports;

use App\Models\PawnAddData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Carbon\Carbon;


HeadingRowFormatter::default('none');

class PawnAddDataImport implements ToModel,WithHeadingRow, WithUpserts, WithChunkReading, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {


         return new PawnAddData([
            'id_card' =>$row['ID_Card']?? null,
            'pawn_id' => $row['Prawn_ID']?? null,
            'pawn_barcode' => $row['Prawn_Barcode']?? null,
            'pawn_expire_date' => Carbon::createFromFormat('n/j/Y h:i:s A', $row['Prawn_Expire_Date'])->format('Y-m-d H:i:s')?? null,
            'pawn_add' => $row['PrawnAdd']?? null,
            'period' => $row['Period']?? null,
            'pawn_date_cal_interest' => Carbon::createFromFormat('n/j/Y h:i:s A', $row['Prawn_Date_Cal_Interest'])->format('Y-m-d H:i:s')?? null,

        ]);
    }

    public function chunkSize(): int
    {
        return 1000; // อ่านทีละ 1000 แถว
    }

    public function batchSize(): int
    {
        return 10000;
    }


    public function uniqueBy()
    {
        return 'id';
    }

     public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }

}
