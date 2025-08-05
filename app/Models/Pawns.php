<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pawns extends Model
{
    use HasFactory;
    protected $guarded = [];

     // Related Models
    public function sub100m()
    {
        return $this->hasOne(PawnSub100mData::class, 'pawn_barcode', 'pawn_barcode');
    }

    public function sub100nm()
    {
        return $this->hasOne(PawnSub100nmData::class, 'pawn_barcode', 'pawn_barcode');
    }

    public function subnm()
    {
        return $this->hasOne(PawnSubnmData::class, 'pawn_barcode', 'pawn_barcode');
    }
}
