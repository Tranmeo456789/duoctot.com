<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'id','longs','wides','highs','mass'
    ];
    protected $primaryKey = 'id';
    protected $table = 'sizes';
}
