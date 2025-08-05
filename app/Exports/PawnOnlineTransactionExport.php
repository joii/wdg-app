<?php

namespace App\Exports;

use App\Models\PawnOnlineTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PawnOnlineTransactionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // ดึงข้อมูลจาก model และแมพเฉพาะ field ที่ต้องการ
        return PawnOnlineTransaction::select('transaction_date', 'transaction_time', 'transaction_type','pawn_barcode','interest','amount','payment_method','customer_name','customer_name','customer_address','customer_phone','remarks','approved_by','is_erased')->get()->map(function ($pawn) {
            return [
                'D_Date' => $pawn->transaction_date,
                'D_Time' => $pawn->transaction_time,
                'Transaction_Type' => $pawn->transaction_type,
                'Barcode' => $pawn->pawn_barcode,
                'interest' => $pawn->interest,
                'amount' => $pawn->amount,
                'payment' => $pawn->payment_method,
                'CustName' => $pawn->customer_name,
                'CustAddress' => $pawn->customer_address,
                'CustTel' => $pawn->customer_phone,
                'Remark' => $pawn->remarks,
                'ApprovedBy' => $pawn->approved_by,
                'Is_Erased' => $pawn->is_erased,

            ];
        });
    }

    public function headings(): array
    {
        return [
            'D_Date',
            'D_Time',
            'Transaction_Type',
            'Barcode',
            'interest',
            'amount',
            'payment',
            'CustName',
            'CustAddress',
            'CustTel',
            'Remark',
            'ApprovedBy',
            'Is_Erased',
        ];
    }


}
