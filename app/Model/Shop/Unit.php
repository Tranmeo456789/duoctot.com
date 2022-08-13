<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'id_unit','name_unit'
    ];
    protected $primaryKey = 'id_unit';
    protected $table = 'units';
}
