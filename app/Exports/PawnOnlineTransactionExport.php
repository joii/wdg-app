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
        return PawnOnlineTransaction::select('transaction_date', 'transaction_time', 'token_id', 'transaction_type','pawn_barcode','number_of_month','interest','amount','payment_amount','payment_method','customer_name','customer_address','customer_phone','id_card','remarks','approved_by','is_erased')->get()->map(function ($pawn) {
            return [
                'D_Date' => $pawn->transaction_date,
                'D_Time' => $pawn->transaction_time,
                'Token_ID' => $pawn->token_id,
                'Transaction_Type' => $pawn->transaction_type,
                'Barcode' => $pawn->pawn_barcode,
                'Period' => $pawn->number_of_month,
                'interest' => $pawn->interest,
                'amount' => $pawn->amount,
                'payment_amount' => $pawn->payment_amount,
                'payment' => $pawn->payment_method,
                'CustName' => $pawn->customer_name,
                'CustAddress' => $pawn->customer_address,
                'CustTel' => $pawn->customer_phone,
                'ID_Card' => $pawn->id_card,
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
            'Token_ID',
            'Transaction_Type',
            'Barcode',
            'Period',
            'interest',
            'amount',
            'Payment amount',
            'Payment_Type',
            'CustName',
            'CustAddress',
            'CustTel',
            'ID_Card',
            'Remark',
            'ApprovedBy',
            'Is_Erased',
        ];
    }


}
