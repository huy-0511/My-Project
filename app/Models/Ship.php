<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    protected $table = 'shipping';

    protected $fillable = [
        'shipping_email','shipping_phone','shipping_name','shipping_address','shipping_note','shipping_method'
    ];
}
