<?php

namespace App\Imports;

use App\Models\PawnSubnmData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Carbon\Carbon;

HeadingRowFormatter::default('none');
class PawnSubNMDataImport implements ToModel,WithHeadingRow, WithUpserts,WithChunkReading,WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PawnSubnmData([
            'pawn_subnm_id' => $row['id_auto'],
            'pawn_barcode' => $row['Prawn_Barcode'],
            'stock_category_id' => $row['Stock_Category_ID'],
            'weight_gram' => $row['Weight_Gram'],
            'price' => $row['Price'],
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
