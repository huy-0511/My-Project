<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
        'customer_name','customer_email','customer_phone','customer_password','level'	
    ];
}
