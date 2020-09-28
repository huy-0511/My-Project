<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $table = 'post';
    protected $fillable = [
        'post_title','cate_post_id','post_desc','post_content','post_meta_desc','post_meta_keywords','post_image','post_slug'
    ];
}
