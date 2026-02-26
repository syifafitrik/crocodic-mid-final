<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterVoucher extends Model
{
    protected $table      = 'master_voucher';
    protected $primaryKey = 'id';
    public $incrementing  = true;
    public $timestamps    = true;

    protected $fillable = [
        'game_id',
        'voucher_title',
        'voucher_value',
        'voucher_price',
        'user_id',
        'created_at',
        'updated_at',
    ];
}
