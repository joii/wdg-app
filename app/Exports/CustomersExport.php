<?php

namespace App\Exports;

use App\Models\Customers;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customers::all();
    }

      public function query()
    {
         return Customers::query();
        // return (new PawnInterestExport)->forYear(2018)->download($filename);
    }
}
