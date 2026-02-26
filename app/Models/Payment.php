<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table      = 'data_payment';
    protected $primaryKey = 'id';
    public $incrementing  = true;
    public $timestamps    = true;

    protected $fillable = [
        'customer_id',
        'voucher_id',
        'voucher_value',
        'payment_id',
        'payment_amount',
        'user_id',
        'status',
        'created_at',
        'updated_at',
    ];
}
