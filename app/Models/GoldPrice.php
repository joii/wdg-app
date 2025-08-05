<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoldPrice extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $fillable = [
    //     'date',
    //     'time',
    //     'buy_gold_bar',
    //     'sell_gold_bar',
    //     'buy_gold_jewelry',
    //     'sell_gold_jewelry',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'date' => 'date',
    //     'time' => 'datetime', // Cast as datetime to easily handle time
    // ];
}
