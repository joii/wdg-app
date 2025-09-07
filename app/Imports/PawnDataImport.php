<?php

namespace App\Imports;

use App\Models\PawnData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Carbon\Carbon;
use App\Events\CsvImported;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\ImportFailed;
use App\Listeners\LogCsvImportFailed;


HeadingRowFormatter::default('none');

class PawnDataImport implements ToModel,WithHeadingRow,WithUpserts, WithChunkReading, WithBatchInserts,WithEvents
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


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PawnData([
            'pawn_id' => $row['Prawn_ID'],
            'pawn_date' => Carbon::createFromFormat('n/j/Y h:i:s A', $row['Prawn_Date'])
            ->format('Y-m-d H:i:s'),
            'pawn_time' => Carbon::createFromFormat('n/j/Y h:i:s A', $row['Prawn_Time'])
            ->format('Y-m-d H:i:s'),
            'pawn_barcode' => $row['Prawn_Barcode'],
            'pawn_card_no' => $row['PrawnCard_No'],
            'period' => $row['Period'],
            'percent_interest' => $row['Percent_Interest'],
            'type_full' => $row['TypeFull'],
            'unit_baht_grand_total' => $row['UnitBathGrandTotal'],
            'unit_quarter_grand_total' => $row['UnitSaluengGrandTotal'],
            'total_weight' => $row['Total_Weight'],
            'total_pawn_amount' => $row['Total_PrawnAmount'],
            'user_name' => $row['User_name'],
            'weight_100m_total' => $row['Weight100MTotal'],
            'price_100m_total' => $row['Price100MTotal'],
            'weight_100nm_total' => $row['Weight100NMTotal'],
            'price_100nm_total' => $row['Price100NMTotal'],
            'weight_nm_total' => $row['WeightNMTotal'],
            'price_nm_total' => $row['PriceNMTotal'],
            'pawn_date_cal_interest' => Carbon::createFromFormat('n/j/Y h:i:s A', $row['Prawn_Date_Cal_Interest'])
            ->format('Y-m-d H:i:s'),
            'is_erased' => $row['Is_Erased'],
            'is_withdrawn' => $row['Is_Withdrawn'],
            'is_yup' => $row['Is_Yup'],
            'customer_name' => $row['Name_Cust'],
            'customer_address' => $row['Addr_Cust'],
            'customer_phone' => $row['Tel_Cust'],
            'comment' => $row['Comment'],
            'date_erased' => $row['Date_Erased'],
            'remarks' => $row['Remarks'],
            'total_pawn_amount_first'  => $row['Total_PrawnAmount_First'],
            'is_chk'  => $row['Is_Chk'],
            'p_no'  => $row['P_No'],
            'id_card'  => $row['ID_Card'],
            'emp_id'  => $row['EmpID'],
            'use_fp'  => $row['use_fp'],
            'is_withdrawn_fp'  => $row['Is_Withdrawn_fp'],
            'is_log'  => $row['Is_log'],
            'sn'  => $row['SN'],
            'warning_msg'  => $row['WarningMsg'],
            'is_vip'  => $row['Is_VIP'],
            'est_price_100m_total' => $row['estPrice100MTotal'],
            'est_price_100nm_total' => $row['estPrice100NMTotal'],
            'remark_overdue' => $row['Remarkoverdue'],
            'emp_face_id' => $row['EmpFaceId'],
            'is_withdrawn_face' => $row['Is_Withdrawn_face'],
            'is_config36' => $row['Is_Config36'],
            'is_pending_yup' => $row['Is_PendingYup'],
            'is_shift_yup' => $this->parseNumeric($row['Is_ShiftYup']),
            //'shift_yup_date' => Carbon::createFromFormat('n/j/Y h:i:s A', $row['ShiftYup_Date'])->format('Y-m-d H:i:s'),
            'shift_yup_desc' =>$row['ShiftYup_Desc'],
            //'expire_date' => Carbon::createFromFormat('n/j/Y h:i:s A', $row['Expire_Date'])->format('Y-m-d H:i:s'),
            'remark_admin' => $row['Remark_Admin'],
            'is_unlock'  => $this->parseNumeric($row['Is_UnLock']),
            'user_name_erased'  => $row['User_Name_Erased'],
           // 'lottery_date'=>Carbon::createFromFormat('n/j/Y h:i:s A', $row['Lottery_Date'])->format('Y-m-d H:i:s'),
            'lottery_4'  => $row['Lottery_4'],
            'lottery_3'  => $row['Lottery_3'],
            'lottery_2'  => $row['Lottery_2'],
            'lottery_1'  => $row['Lottery_1'],
            'lottery_winning'  => $row['Lottery_Winning'],
            'lottery_expire'  => $row['Lottery_Expire'],
            'lottery_reward'  => $row['Lottery_Reward'],
            'lottery_barcode'  => $row['Lottery_Barcode'],
            'pawn_online_status' => $row['PrawnOnline'],
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
