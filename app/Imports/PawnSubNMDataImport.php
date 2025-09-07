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
use App\Events\CsvImported;
use App\Jobs\ProcessPanSub100MDataJob;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\ImportFailed;
use App\Listeners\LogCsvImportFailed;

HeadingRowFormatter::default('none');
class PawnSubNMDataImport implements ToModel,WithHeadingRow, WithUpserts,WithChunkReading,WithBatchInserts,WithEvents
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $filename;

     // รับชื่อไฟล์เข้ามา
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

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

     public function registerEvents(): array
    {
        return [
            AfterImport::class => function(AfterImport $event) {
                // Trigger Event หลัง Import เสร็จ  พร้อมชื่อไฟล์ dynamic
               event(new CsvImported($this->filename)); // Event Generic + Dynamic Parameter
               //event(new PawnSub100MCsvImported($this->filename));  // use case

            },
            ImportFailed::class => [LogCsvImportFailed::class, 'handle'],

        ];
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
