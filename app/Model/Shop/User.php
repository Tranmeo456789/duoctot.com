<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'id','name','email','phone','local','customer_group','code','password'
    ];
    protected $primaryKey = 'id';
    protected $table = 'users';
}
