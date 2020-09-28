<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'tinhthanhpho';
    protected $fillable = [
        'name_city','type'
    ];
}
