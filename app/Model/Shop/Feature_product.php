<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Feature_product extends Model
{
    protected $fillable = [
        'id','name','product_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'feature_products';
    public function product(){
        return $this->belongsTo('App\Model\Shop\Product');
    }
}
