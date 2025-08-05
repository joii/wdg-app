<?php

namespace App\Exports;

use App\Models\PawnInterests;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PawnInterestExport implements FromQuery,WithHeadings
{



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
            'CreatedAt',
            'UpdatedAt',
        ];
    }

    public function query()
  {
       return PawnInterests::query();
      // return (new PawnInterestExport)->forYear(2018)->download($filename);
  }
}
