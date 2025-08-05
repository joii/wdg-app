<?php

namespace App\Imports;

use App\Models\PawnSub100nmData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Carbon\Carbon;


HeadingRowFormatter::default('none');
class PawnSub100NMDataImport implements ToModel,WithHeadingRow, WithUpserts,WithChunkReading,WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PawnSub100nmData([
            'pawn_sub100nm_id' => $row['id_auto'],
            'pawn_barcode' => $row['Prawn_Barcode'],
            'stock_category_id' => $row['Stock_Category_ID'],
            'weight_gram' => $row['Weight_Gram'],
            'quantity' => $row['Qty'],
            'is_erased' => $row['Is_Erased'],
        ]);
    }

     public function chunkSize(): int
    {
        return 500; // อ่านทีละ 1000 แถว
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function uniqueBy()
    {
        return 'id';
    }
}
