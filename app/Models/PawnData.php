<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PawnData extends Model
{
    use HasFactory;
    protected $fillable = [
        'pawn_id',
        'pawn_date',
        'pawn_time',
        'pawn_barcode',
        'pawn_card_no',
        'period',
        'percent_interest',
        'type_full',
        'unit_baht_grand_total',
        'unit_quarter_grand_total',
        'total_weight',
        'total_pawn_amount',
        'user_name',
        'weight_100m_total',
        'price_100m_total',
        'weight_100nm_total',
        'price_100nm_total',
        'weight_nm_total',
        'price_nm_total',
        'pawn_date_cal_interest',
        'is_erased',
        'is_withdrawn',
        'is_yup',
        'customer_name',
        'customer_address',
        'customer_phone',
        'comment',
        'date_erased',
        'remarks',
        'total_pawn_amount_first',
        'is_chk',
        'p_no',
        'id_card',
        'emp_id',
        'use_fp',
        'is_withdrawn_fp',
        'is_log',
        'sn',
        'warning_msg',
        'is_vip',
        'est_price_100m_total',
        'est_price_100nm_total',
        'remark_overdue',
        'emp_face_id',
        'is_withdrawn_face',
        'is_config36',
        'is_pending_yup',
        'is_shift_yup',
        'shift_yup_date',
        'shift_yup_desc',
        'expire_date',
        'remark_admin',
        'is_unlock',
        'user_name_erased',
        'lottery_date',
        'lottery_4',
        'lottery_3',
        'lottery_2',
        'lottery_1',
        'lottery_winning',
        'lottery_expire',
        'lottery_reward',
        'lottery_barcode',
        'pawn_online_status'

    ];

    public static function getPawnDataRecords()
    {
        return self::select('pawn_id', 'pawn_barcode', 'total_weight','total_pawn_amount','type_full')->OrderBy('id', 'DESC')->get();
    }


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
