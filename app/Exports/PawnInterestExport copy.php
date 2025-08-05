<?php

namespace App\Exports;

use App\Models\PawnInterests;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;


class PawnInterestExport implements FromCollection,
WithHeadings,
WithMapping
{
    use Exportable;
    private $filters;

    // public function __construct($filters)
    // {
    //     $this->filters = $filters;
    // }

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function map($pawn_interest):array
    {
        return [
            $pawn_interest->customer_id,
            /* Carbon::parse($pawn_interest->pawn_interest_date)->format('m/d/Y H:i'), */
            $pawn_interest->pawn_interest_date,
            $pawn_interest->pawn_interest_time,
            $pawn_interest->pim_card_no,
            $pawn_interest->pawn_barcode,
            $pawn_interest->month_how,
            $pawn_interest->day_how,
            $pawn_interest->interest_amount,
            $pawn_interest->interest_amount_before,
            $pawn_interest->remark,
            $pawn_interest->is_erased,
            $pawn_interest->is_min,
            $pawn_interest->date_erased,
            $pawn_interest->is_chk,
            $pawn_interest->use_fp,
            $pawn_interest->is_no_card,
            $pawn_interest->loss_card,
            $pawn_interest->staff,
            $pawn_interest->user_name_erased,
        ];
    }


    public function headings(): array
    {
        return [
            'PrawnInterest_ID',
            'Cust_ID',
            'PrawnInterest_Date',
            'PrawnInterest_Time	',
            'PimCard_No',
            'Prawn_Barcode',
            'Month_How',
            'Day_How',
            'InterestAmount',
            'InterestAmountBefore',
            'Remark',
            'Is_Erase',
            'Is_Min',
            'Date_Erase',
            'Is_Chk',
            'use_fp',
            'Is_Nocard',
            'losscard',
            'Staff',
            'User_Name_Erased',
        ];
    }


    public function collection()
    {
        //return PawnInterests::query();
        // return (new PawnInterestExport)->forYear(2018)->download($filename);
        return PawnInterests::filter($this->filters)->get();
    }
}
