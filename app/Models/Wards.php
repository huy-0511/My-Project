<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
     protected $table = 'xaphuongthitran';
    protected $fillable = [
        'name_phuong','type','id_maqh'
    ];
}
