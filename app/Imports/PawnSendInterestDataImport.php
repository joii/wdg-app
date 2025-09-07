<?php

namespace App\Imports;

use App\Models\PawnSendInterestData;
use App\Events\CsvImported;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\ImportFailed;
use App\Listeners\LogCsvImportFailed;



HeadingRowFormatter::default('none');

class PawnSendInterestDataImport implements ToModel,WithHeadingRow,WithUpserts,WithChunkReading,WithBatchInserts,WithEvents
{

    protected $filename;

    // รับชื่อไฟล์เข้ามา
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    private function parseNumeric($value)
    {
        if ($value === null || $value === '' || strtoupper($value) === 'NULL') {
            return 0;
        }

        return is_numeric($value) ? $value : null;
    }

    public function model(array $row)
    {
        return new PawnSendInterestData([
            'id_card' => $row['ID_Card'],
            'pawn_id' => $row['Prawn_ID'],
            'pawn_barcode' => $row['Prawn_Barcode'],
            'pawn_expire_date' => Carbon::createFromFormat('n/j/Y h:i:s A', $row['Prawn_Expire_Date'])
            ->format('Y-m-d H:i:s'),
            'interest' => $row['Interest'],
            'period' => $row['Period'],
            'pawn_cal_interest_date' => Carbon::createFromFormat('n/j/Y h:i:s A', $row['Prawn_Date_Cal_Interest'])
            ->format('Y-m-d H:i:s'),
            'total_pawn_amount' => $row['Total_PrawnAmount'],
            'pawn_card_no' => $row['PrawnCard_No'],
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
