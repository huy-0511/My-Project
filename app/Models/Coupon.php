<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupon';

    protected $fillable = [
        'coupon_name','coupon_time','coupon_condition','coupon_number','coupon_code'	
    ];
}
