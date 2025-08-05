<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PawnSubnmData extends Model
{
    use HasFactory;
    protected $guarded =[];

    public static function getPawnSubnmDataRecords()
    {
        return self::select('pawn_barcode', 'stock_category_id','weight_gram','quantity','price','is_erased')->OrderBy('id', 'DESC')->get();
    }
}
