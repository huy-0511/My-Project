<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	
    protected $table = 'product';

    protected $fillable = [
        'category_id','brand_id','product_name','product_desc','product_content','product_price','product_image','product_qty','product_sold','product_tags'	
    ];
}
