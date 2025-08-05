<?php

namespace App\Exports;

use App\Models\PawnSubnmData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PawnSubNMDataExport implements FromQuery,WithHeadings
{
    public function headings(): array
    {
        return [

            'id_auto',
            'Prawn_Barcode',
            'Stock_Category_ID',
            'Weight_Gram',
            'Qty',
            'Is_Erased',
            'Price',
        ];
    }

    public function query()
    {
         return PawnSubnmData::query();
        // return (new PawnInterestExport)->forYear(2018)->download($filename);
    }
}
