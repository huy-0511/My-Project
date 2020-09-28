<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatePost extends Model
{
    protected $table = 'category_post';
    protected $fillable = [
        'cate_post_name', 'cate_post_slug','cate_post_desc'
    ];
}
