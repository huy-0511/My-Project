<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
     protected $table = 'order_tails';

    protected $fillable = [
        'order_details_code','product_id','product_name','product_price','product_sales_quantily','product_fee','product_coupon'	
    ];
    public function product(){
 		return $this->belongsTo('App\Models\Product','id');
 	}
}
