<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customers extends Model
{
    use HasFactory;
    protected $guarded =[];


    public static function getCustomersRecords()
    {
        return self::select('name','address','tel')->OrderBy('id', 'DESC')->take(10)->get();
    }
}
