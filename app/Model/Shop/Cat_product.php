<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Cat_product extends Model
{
    protected $fillable = [
        'id','name','image','parent_id','slug'
    ];
    protected $primaryKey = 'id';
    protected $table = 'cat_products';
     public function products(){
         return $this->hasMany('App\Model\Shop\Product');
    }
    
}
