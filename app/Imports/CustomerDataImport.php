<?php

namespace App\Imports;

use App\Models\Customers;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;


HeadingRowFormatter::default('none');

class CustomerDataImport implements ToModel,WithHeadingRow,WithUpserts,WithChunkReading,SkipsOnError,WithBatchInserts
{

    use Importable, SkipsErrors;
    private function parseNumeric($value)
    {
        if ($value === null || $value === '' || strtoupper($value) === 'NULL') {
            return 0;
        }

        return is_numeric($value) ? $value : null;
    }

    private function parseDate($dateString, $format = null)
    {
        if (empty($dateString)) {
            return '0000-00-00 00:00:00';
        }

        if ($dateString === null || $dateString === NULL || $dateString === '' || strtoupper($dateString) === 'NULL') {
            return '0000-00-00 00:00:00';
        }

        try {
            $date = $format
                ? Carbon::createFromFormat($format, $dateString)
                : Carbon::parse($dateString);

            return $date->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return '0000-00-00 00:00:00';
        }
    }

    private function parseBool($value): int
    {
        $trueValues = ['TRUE','true', '1', 'yes', 'on'];
        $falseValues = ['FALSE','false', '0', 'no', 'off'];

        $value = strtolower(trim($value));

        if (in_array($value, $trueValues, true)) {
            return 1;
        }

        if (in_array($value, $falseValues, true)) {
            return 0;
        }

        // default fallback
        return 0;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customers([
             'customer_id' => $row['id_auto']?? null,
             'name' => $row['name']?? null,
             'address' => $row['address']?? null,
             'tel' => $row['tel']?? null,
             'is_date' => $this->parseBool($row['Is_Date'])?? null,
             'date_of_birth' => $this->parseDate($row['D_Birth'])?? null,
             'comment' => $row['comment']?? null,
             'id_card' => $row['ID_Card']?? null,
             'emp_id' => $this->parseNumeric($row['EmpId'])?? null,
             'is_delete' => $this->parseBool($row['IsDelete'])?? null,
             'member_id' => $row['MemberId']?? null,
             'emp_face_id' => $this->parseNumeric($row['EmpFaceId'])?? null,
             'customer_image_id' => $row['CustomerImageId']?? null,
             'pawn_online' => $row['PrawnOnline']?? null,
        ]);
    }

    public function chunkSize(): int
    {
        return 1000; // อ่านทีละ 1000 แถว
    }

    public function batchSize(): int
    {
        return 1000;
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
