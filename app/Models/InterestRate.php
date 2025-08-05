<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestRate extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function branch() {
        return $this->belongsTo('App\Branch','branch_id','id');
    }
}
