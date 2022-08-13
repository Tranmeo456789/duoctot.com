<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Producer extends Model
{
    protected $fillable = [
        'id_producer','name_producer'
    ];
    protected $primaryKey = 'id_producer';
    protected $table = 'producers';
}
