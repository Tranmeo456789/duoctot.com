<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'id','name','local'
    ];
    protected $primaryKey = 'id';
    protected $table = 'warehouses';
}
